#!/bin/bash

# Aguarda o banco ficar disponível
echo "Aguardando o banco de dados..."
until pg_isready -h $DB_HOST -p $DB_PORT -U $DB_USERNAME; do
  sleep 2
done

echo "Banco de dados disponível. Rodando migrations..."
php artisan migrate --force

# Inicia o Laravel
php artisan serve --host=0.0.0.0 --port=8000
