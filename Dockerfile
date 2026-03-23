FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    nginx \
    supervisor \
    netcat-openbsd

RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_pgsql mbstring bcmath opcache zip gd exif

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www/html
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Create before build
RUN mkdir -p public/build

# Give permissions
RUN chown -R www-data:www-data public/build

# Install Node.js dependencies and build assets
RUN npm install \
    && rm -rf public/build \
    && npm run build \
    && ls -R public/build

# Clear Laravel log file for fresh deploy
RUN mkdir -p storage/logs \
    && touch storage/logs/laravel.log \
    && chown -R www-data:www-data storage bootstrap/cache

COPY ./deploy/nginx/naima.conf /etc/nginx/sites-available/default
COPY ./deploy/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./deploy/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 80

CMD ["/usr/local/bin/start.sh"]
