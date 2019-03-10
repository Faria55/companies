# Running project

1. git clone https://github.com/Faria55/companies.git
2. cd companies
3. composer install
4. cp .env.example .env and fill database credentials on .env file
5. php artisan key:generate
6. php artisan migrate --seed
7. php artisan storage:link
8. php artisan serve

Templating part could be much better...
