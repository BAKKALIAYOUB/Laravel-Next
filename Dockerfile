# Use an official PHP runtime as a parent image
FROM php:8.2-fpm

# Set the working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql

# Copy the Laravel application code into the container
COPY . .

# Install Composer and run dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer validate --no-check-publish && composer install --prefer-dist --no-progress
RUN php artisan optimize

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
