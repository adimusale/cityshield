# Dockerfile for deploying CityShield (PHP + Apache + SQLite) on Render / Railway
FROM php:8.2-apache

# Install SQLite PDO extension
RUN apt-get update && apt-get install -y libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files into Apache web root
COPY . /var/www/html/

# Set file permissions for database directory
RUN chown -R www-data:www-data /var/www/html/database \
    && chmod -R 775 /var/www/html/database

EXPOSE 80
CMD ["apache2-foreground"]
