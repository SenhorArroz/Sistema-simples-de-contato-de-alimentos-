# Use a imagem base do PHP 8.2-fpm
FROM php:8.2-fpm

# Define o diretório de trabalho
WORKDIR /var/www

# Instala dependências do sistema e cliente do PostgreSQL
RUN apt-get update && apt-get install -y \
    zip unzip curl git libxml2-dev libzip-dev libpng-dev libjpeg-dev libonig-dev \
    postgresql-client libpq-dev --no-install-recommends && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Instala as extensões do PHP necessárias para o Laravel
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip

# Instala o Composer globalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia os arquivos da aplicação
COPY . /var/www

# Instala as dependências do Composer sem scripts de dev e de forma otimizada
RUN composer install --no-dev --optimize-autoloader

# Ajusta as permissões para o usuário www-data
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Copia e torna o script de entrada executável
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Expõe a porta que o Render vai usar
EXPOSE 8000

# Define o script de entrada como o comando principal do container
ENTRYPOINT ["/entrypoint.sh"]
