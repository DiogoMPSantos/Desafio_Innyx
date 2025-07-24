#!/bin/sh

# Ajusta permissões para storage e bootstrap/cache
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Executa o comando padrão do container (php-fpm)
exec "$@"
