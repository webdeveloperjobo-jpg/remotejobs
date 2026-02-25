FROM php:8.2-apache

# Enable mysqli extension
RUN docker-php-ext-install mysqli

# Copy all project files into Apache directory
COPY . /var/www/html/

# Give proper permissions
RUN chown -R www-data:www-data /var/www/html
