git clone <repository_url>
cd <project_directory>
composer install
cp .env.example .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<your_database_name>
DB_USERNAME=<your_database_username>
DB_PASSWORD=<your_database_password>
php artisan key:generate

php artisan migrate

php artisan db:seed --class=ManagerUserSeeder
This will create a manager user with the email manager@example.com and the password secretpassword

npm install
npm run dev

php artisan serve
