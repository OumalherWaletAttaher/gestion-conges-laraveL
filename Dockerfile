FROM php:8.4-fpm-alpine

# Dépendances système
RUN apk add --no-cache nginx supervisor git unzip libpng-dev libzip-dev icu-dev postgresql-dev linux-headers

# Extensions PHP indispensables pour Laravel + PostgreSQL (NeonDB)
RUN docker-php-ext-install pdo pdo_pgsql bcmath zip intl

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Installation des dépendances sans dev
RUN composer install --no-dev --optimize-autoloader

# Config Nginx minimale intégrée
RUN echo 'server { \
    listen 80; \
    root /var/www/html/public; \
    index index.php; \
    location / { try_files $uri $uri/ /index.php?$query_string; } \
    location ~ \.php$ { \
        fastcgi_pass 127.0.0.1:9000; \
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; \
        include fastcgi_params; \
    } \
}' > /etc/nginx/http.d/default.conf

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

# Démarrage de PHP-FPM et Nginx
CMD php-fpm -D && nginx -g 'daemon off;'