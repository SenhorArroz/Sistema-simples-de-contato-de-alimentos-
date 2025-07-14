FROM php:8.2-fpm

WORKDIR /var/www

# Instala dependências do sistema e postgresql-client
RUN apt-get update && apt-get install -y \
    zip unzip curl git libxml2-dev libzip-dev libpng-dev libjpeg-dev libonig-dev \
    sqlite3 libsqlite3-dev postgresql-client

# Instala extensões do PHP, incluindo PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip

# Copia o Composer do container oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia os arquivos da aplicação
COPY . /var/www
COPY --chown=www-data:www-data . /var/www

# Permissões e dependências
RUN chmod -R 755 /var/www
RUN composer install

# Geração da key
COPY .env.example .env
RUN php artisan key:generate

# Adiciona e configura o entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8000

# Define o entrypoint e remove o CMD antigo
ENTRYPOINT ["/entrypoint.sh"]
