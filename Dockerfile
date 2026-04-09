FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip libzip-dev unzip git &&     docker-php-ext-configure gd --with-freetype --with-jpeg &&     docker-php-ext-install pdo pdo_mysql gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN a2enmod rewrite
WORKDIR /var/www/html
COPY . /var/www/html

# Install Laravel core
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Create database folder and file manually
RUN mkdir -p /var/www/html/database &&     touch /var/www/html/database/database.sqlite &&     chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Apache Config
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -i 's/Listen 80/Listen ${PORT}/' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost \*:80>/<VirtualHost \*:${PORT}>/' /etc/apache2/sites-available/000-default.conf

# Start script: Migrate then start Apache
CMD php artisan migrate --force --seed && apache2-foreground
