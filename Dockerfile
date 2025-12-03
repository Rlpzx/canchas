FROM php:8.2-cli

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring gd xml zip

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader
RUN php artisan key:generate

# Permisos
RUN chmod -R 775 storage bootstrap/cache

# Render usa puerto dinámico
ENV PORT=10000

EXPOSE 10000

CMD php artisan serve --host 0.0.0.0 --port $PORT
