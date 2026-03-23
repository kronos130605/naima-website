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
if [ "$DB_CONNECTION" = "pgsql" ]; then
    echo "⏳ Waiting for PostgreSQL database..."
    
    # Install postgresql-client for pg_isready
    apk add --no-cache postgresql-client
    
    # Wait up to 60 seconds for database
    RETRIES=60
    until pg_isready -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USERNAME" > /dev/null 2>&1 || [ $RETRIES -eq 0 ]; do
        echo "Waiting for PostgreSQL, $((RETRIES--)) remaining attempts..."
        sleep 1
    done
    
    if [ $RETRIES -eq 0 ]; then
        echo "❌ PostgreSQL did not become ready in time"
        exit 1
    fi
    
    echo "✅ PostgreSQL is ready!"
fi

# Run migrations
echo "🔄 Running migrations..."
php artisan migrate --force --no-interaction || {
    echo "⚠️  Migration failed, but continuing..."
}

# Clear and cache config
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
