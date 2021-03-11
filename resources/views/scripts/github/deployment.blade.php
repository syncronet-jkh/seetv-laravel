set -e

cd {{ base_path() }}

git pull origin {{ $deployment->branch }}

composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

php artisan migrate --force

php artisan optimize

npm install

npm run production
