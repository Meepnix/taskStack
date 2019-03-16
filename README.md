# taskStack

Installation

1. git clone task project into htdocs

2. cd into task project

3. Install composer, once installed run: 

composer install

4. Install npm, once installed run:

npm install

5. create copy of .env.example 

cp .env.example .env

6. generate encryption key

php artisan key:generate

7. create empty database, collation utf8mb4_unicode_ci

8. migrate database:

php artisan migrate

9 create storage link:

php artisan storage:link
