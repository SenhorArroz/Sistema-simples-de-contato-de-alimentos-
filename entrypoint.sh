#!/bin/bash

echo "Aguardando o banco de dados $DB_HOST:$DB_PORT..."

until pg_isready -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USERNAME"; do
  sleep 2
done

echo "Banco de dados disponível! Rodando migrations..."
php artisan migrate --force

echo "Iniciando servidor Laravel..."
exec php artisan serve --host=0.0.0.0 --port=8000
