#!/bin/bash
set -e

cd /var/www/html

# Pastikan .env ada
if [ ! -f .env ]; then
    echo "ERROR: .env file not found. Rebuild the image."
    exit 1
fi

# Hapus config cache lama agar key:generate bisa berjalan
php artisan config:clear 2>/dev/null || true

# Generate APP_KEY jika kosong
APP_KEY_VAL=$(grep '^APP_KEY=' .env | cut -d'=' -f2-)
if [ -z "$APP_KEY_VAL" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
    echo "APP_KEY generated."
fi

# Tunggu MySQL siap
echo "Waiting for MySQL to be ready..."
MAX_TRIES=30
COUNT=0

DB_H=$(grep '^DB_HOST=' .env | cut -d'=' -f2-)
DB_P=$(grep '^DB_PORT=' .env | cut -d'=' -f2-)
DB_N=$(grep '^DB_DATABASE=' .env | cut -d'=' -f2-)
DB_U=$(grep '^DB_USERNAME=' .env | cut -d'=' -f2-)
DB_W=$(grep '^DB_PASSWORD=' .env | cut -d'=' -f2-)

DB_H=${DB_H:-db}
DB_P=${DB_P:-3306}
DB_N=${DB_N:-simon_dm}
DB_U=${DB_U:-simon_user}
DB_W=${DB_W:-simon_secret}

until php -r "
    try {
        new PDO('mysql:host=${DB_H};port=${DB_P};dbname=${DB_N}', '${DB_U}', '${DB_W}');
        exit(0);
    } catch (Exception \$e) {
        exit(1);
    }
" 2>/dev/null; do
    COUNT=$((COUNT+1))
    if [ $COUNT -ge $MAX_TRIES ]; then
        echo "MySQL did not become ready in time. Exiting."
        exit 1
    fi
    echo "MySQL not ready yet ($COUNT/$MAX_TRIES), retrying in 3s..."
    sleep 3
done
echo "MySQL is ready."

# Jalankan migrasi
echo "Running migrations..."
php artisan migrate --force

# Jalankan seeder (abaikan jika data sudah ada)
echo "Running seeders..."
php artisan db:seed --force 2>/dev/null || true

# Buat symbolic link storage
php artisan storage:link --force 2>/dev/null || true

# Cache config, route, view (setelah APP_KEY sudah valid)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "Application startup complete. Access at http://localhost:8090"

mkdir -p /var/log/supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
