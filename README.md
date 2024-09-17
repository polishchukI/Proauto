composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed / php artisan migrate:fresh --seed
npm install
npm run dev
npm run prod
