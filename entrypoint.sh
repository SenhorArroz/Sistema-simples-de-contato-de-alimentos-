#!/bin/bash

echo "Aguardando o banco de dados em $DB_HOST:$DB_PORT..."

# Aguarda o banco de dados ficar disponível
until pg_isready -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USERNAME"; do
  sleep 2
done

echo "Banco disponível! Rodando migrations..."
php artisan migrate --force

echo "Iniciando servidor Laravel na porta 8000..."
exec php artisan serve --host=0.0.0.0 --port=8000
