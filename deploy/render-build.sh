#!/bin/bash
# Build script for Render.com (alternative to Dockerfile if needed)

set -e

echo "🏗️  Building Laravel application for Render.com..."

# Install PHP dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build assets
echo "📦 Installing NPM dependencies..."
npm ci

echo "🎨 Building frontend assets..."
npm run build

# Clear and optimize Laravel
echo "⚙️  Optimizing Laravel..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "✅ Build complete!"
