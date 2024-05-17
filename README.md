## Techstack

1. PHP 8.0.2
2. jquery
3. MySQL 5.7
4. Docker

## Question A instructions

1. docker compose build
2. docker compose up -d
3. visit localhost:8989 to run the program

## Question B instructions

# Please refer to question_b folder for explanations and answer (questionB.sql). To generate sample tables for question B, you may follow the instructions below

1. ssh connect to docker ssh
2. php artisan migrate --path=/database/migrations/assessment_test
3. php artisan db:seed --class=DatabaseSeeder , this command will create 100 sets of data, you may want to run few times to further test high load data retrieval
