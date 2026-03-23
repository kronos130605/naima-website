#!/bin/bash
# Start script for Render.com (alternative to Docker CMD if needed)

set -e

echo "🚀 Starting Laravel application..."

# Wait for database
if [ "$DB_CONNECTION" = "pgsql" ]; then
    echo "⏳ Waiting for PostgreSQL..."
    
    # Simple wait for PostgreSQL
    for i in {1..30}; do
        if pg_isready -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USERNAME" > /dev/null 2>&1; then
            echo "✅ PostgreSQL is ready!"
            break
        fi
        echo "Waiting for database... ($i/30)"
        sleep 2
    done
fi

# Run migrations
echo "🔄 Running migrations..."
php artisan migrate --force --no-interaction

# Cache configuration
echo "⚙️  Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link || true

# Set permissions
echo "🔐 Setting permissions..."
chmod -R 775 storage bootstrap/cache

echo "✅ Application ready!"

# Start the application
# For Apache/Nginx: just keep the container running
# For PHP built-in server (development only):
# php artisan serve --host=0.0.0.0 --port=$PORT
