#!/bin/sh
set -eu

mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache

if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
    db_path="${DB_DATABASE:-database/database.sqlite}"
    case "$db_path" in
        /*) ;;
        *) db_path="/var/www/html/$db_path" ;;
    esac
    mkdir -p "$(dirname "$db_path")"
    touch "$db_path"
fi

php artisan migrate --force

exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
