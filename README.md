git clone https://github.com/VladimirKrasikov/pizza-project-zbs.git
cd pizza-project-zbs
composer install
npm install 
npm run dev
переименуйте .env.example в .env
откройте файл .env и настройте БД

DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

php artisan key:generate
php artisan migrate
php artisan serve
php artisan db:seed






  
