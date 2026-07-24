FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    libicu-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN echo "display_errors=Off" >> /usr/local/etc/php/conf.d/docker-php-errors.ini
RUN echo "error_reporting=E_ALL & ~E_DEPRECATED & ~E_NOTICE" >> /usr/local/etc/php/conf.d/docker-php-errors.ini

COPY . .

RUN composer install --optimize-autoloader --no-dev

RUN npm install && npm run build

RUN php artisan storage:link || true

EXPOSE 10000

CMD php artisan migrate --force && php artisan db:seed --class=AdminUserSeeder --force && php artisan serve --host=0.0.0.0 --port=10000