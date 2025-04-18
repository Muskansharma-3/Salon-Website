# Use official PHP image with Apache
FROM php:8.2-apache

# Install required PHP extensions and tools
RUN apt-get update && apt-get install -y \
    libzip-dev unzip sqlite3 libsqlite3-dev git curl \
    && docker-php-ext-install pdo pdo_sqlite zip

# Enable Apache Rewrite Module
RUN a2enmod rewrite

# Set working directory in container
WORKDIR /var/www/html

# Copy all Laravel files into the container
COPY . .

# Install Composer (PHP dependency manager)
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Use custom Apache virtual host config (we will create this next)
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Expose port 80 for web traffic
EXPOSE 80
