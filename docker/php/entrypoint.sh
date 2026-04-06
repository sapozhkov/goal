#!/bin/sh
set -eu

cd /app

copy_if_missing() {
  src="$1"
  dst="$2"

  if [ ! -f "$dst" ] && [ -f "$src" ]; then
    cp "$src" "$dst"
  fi
}

copy_if_missing config/db.php.dist config/db.php
copy_if_missing config/web-local.php.dist config/web-local.php
copy_if_missing config/console-local.php.dist config/console-local.php
copy_if_missing config/params-local.php.dist config/params-local.php
copy_if_missing config/users.php.dist config/users.php

mkdir -p runtime web/assets
chmod -R 0777 runtime web/assets

if [ ! -f vendor/autoload.php ]; then
  composer install --prefer-dist --no-interaction
fi

if [ -n "${DB_HOST:-}" ]; then
  echo "Waiting for database at ${DB_HOST}:${DB_PORT:-3306}..."
  until mysqladmin ping -h"${DB_HOST}" -P"${DB_PORT:-3306}" -u"${DB_USERNAME}" -p"${DB_PASSWORD}" --silent; do
    sleep 2
  done
fi

php yii migrate --interactive=0

exec "$@"
