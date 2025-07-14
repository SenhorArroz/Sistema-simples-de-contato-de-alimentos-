FROM php:8.2-fpm

WORKDIR /var/www

# Instala dependências do sistema, PostgreSQL e utilitários
RUN apt-get update && apt-get install -y \
    zip unzip curl git libxml2-dev libzip-dev libpng-dev libjpeg-dev libonig-dev \
    sqlite3 libsqlite3-dev postgresql-client libpq-dev

# Instala extensões do PHP necessárias
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia os arquivos da aplicação Laravel
COPY . /var/www
COPY --chown=www-data:www-data . /var/www

# Define permissões e instala dependências PHP
RUN chmod -R 755 /var/www
RUN composer install

# Cria .env e gera APP_KEY
COPY .env.example .env
RUN php artisan key:generate

# Copia o script de entrada
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Expõe a porta do servidor Laravel
EXPOSE 8000

# Define o entrypoint que aguarda o banco e roda migrations
ENTRYPOINT ["/entrypoint.sh"]
