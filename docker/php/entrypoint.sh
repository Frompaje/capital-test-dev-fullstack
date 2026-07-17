#!/bin/sh
set -e

cd /var/www/html

if [ ! -f .env ]; then
  echo "[entrypoint] Creating .env from .env.example"
  cp .env.example .env
fi

echo "[entrypoint] Waiting for PostgreSQL..."
until php -r "
  try {
    new PDO(
      'pgsql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_DATABASE'),
      getenv('DB_USERNAME'),
      getenv('DB_PASSWORD')
    );
    exit(0);
  } catch (Throwable \$exception) {
    exit(1);
  }
"; do
  sleep 1
done
echo "[entrypoint] PostgreSQL is ready"

if [ ! -d vendor ] || [ ! -f vendor/autoload.php ]; then
  echo "[entrypoint] Installing Composer dependencies..."
  composer install --no-interaction --prefer-dist --optimize-autoloader
fi

if ! grep -qE '^APP_KEY=base64:.+' .env; then
  echo "[entrypoint] Generating application key..."
  php artisan key:generate --force
fi

echo "[entrypoint] Running migrations..."
php artisan migrate --force

php -r '
require "vendor/autoload.php";
$app = require_once "bootstrap/app.php";
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
if (App\Models\Enterprise::query()->count() === 0) {
    echo "[entrypoint] Seeding database...\n";
    passthru("php artisan db:seed --force", $exitCode);
    exit($exitCode);
}
echo "[entrypoint] Database already seeded\n";
'

echo "[entrypoint] Starting PHP-FPM..."
exec php-fpm
