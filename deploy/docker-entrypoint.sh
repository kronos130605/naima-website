#!/bin/sh
set -e

echo "🚀 Starting Laravel application on Render.com..."

# Use PORT environment variable from Render (default to 80)
export PORT=${PORT:-80}

# Update nginx config with actual PORT
echo "📝 Configuring Nginx to listen on port $PORT..."
envsubst '${PORT}' < /etc/nginx/http.d/default.conf > /tmp/default.conf
mv /tmp/default.conf /etc/nginx/http.d/default.conf

# Wait for PostgreSQL to be ready
if [ "$DB_CONNECTION" = "pgsql" ] && [ -n "$DATABASE_URL" ]; then
    echo "⏳ Waiting for PostgreSQL database..."
    
    # Update Alpine package cache and install postgresql-client
    apk update
    apk add --no-cache postgresql-client
    
    # Parse DATABASE_URL to get host
    # Format: postgresql://user:pass@host:port/database
    DB_HOST_FROM_URL=$(echo "$DATABASE_URL" | sed -n 's/.*@\([^:]*\):.*/\1/p')
    DB_PORT_FROM_URL=$(echo "$DATABASE_URL" | sed -n 's/.*:\([0-9]*\)\/.*/\1/p')
    
    echo "Connecting to PostgreSQL at $DB_HOST_FROM_URL:$DB_PORT_FROM_URL..."
    
    # Wait up to 30 seconds for database (reduced from 60)
    RETRIES=30
    until pg_isready -h "$DB_HOST_FROM_URL" -p "$DB_PORT_FROM_URL" > /dev/null 2>&1 || [ $RETRIES -eq 0 ]; do
        echo "Waiting for PostgreSQL, $((RETRIES--)) remaining attempts..."
        sleep 1
    done
    
    if [ $RETRIES -eq 0 ]; then
        echo "⚠️  PostgreSQL connection timeout - continuing anyway (migrations will fail if DB is not ready)"
    else
        echo "✅ PostgreSQL is ready!"
    fi
fi

# Clear config before migrations (important for DATABASE_URL parsing)
echo "⚙️  Clearing config cache..."
php artisan config:clear

# Run migrations
echo "🔄 Running migrations..."
php artisan migrate --force --no-interaction || {
    echo "⚠️  Migration failed - database may not be ready yet"
    echo "⚠️  You may need to run migrations manually: php artisan migrate --force"
}

# Cache config after migrations
echo "⚙️  Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link if it doesn't exist
if [ ! -L /var/www/html/public/storage ]; then
    echo "🔗 Creating storage symlink..."
    php artisan storage:link || echo "⚠️  Storage link already exists or failed"
fi

# Set correct permissions
echo "🔐 Setting permissions..."
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

echo "✅ Application ready on port $PORT!"

# Execute the main command
exec "$@"
