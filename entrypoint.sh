#!/bin/sh

# Encerra o script imediatamente se qualquer comando falhar
set -e

# 1. Limpa o cache de configuração do Laravel.
#    Este é o comando mais importante. Ele força o Laravel a ler as variáveis de ambiente
#    novas que o Render injetou no container (DB_HOST, DB_PASSWORD, etc.).
echo "Limpando o cache de configuração..."
php artisan config:clear

# 2. Roda as migrations do banco de dados.
#    Agora que a configuração está correta, as migrations vão funcionar.
echo "Rodando as migrations..."
php artisan migrate --force

# 3. Inicia o servidor do Laravel.
#    O comando 'exec' substitui o processo do shell pelo do php, que é a prática recomendada.
echo "Iniciando o servidor Laravel na porta ${PORT}..."
exec php artisan serve --host=0.0.0.0 --port=${PORT}
