# Test Goparity Wanessa Motta

Amortization Payment System in Laravel and Node.js

> The system was based on a queue system for handling a large amount of data. Therefore, it needs to run the queue for things to happen (or in the future, consider adding Redis or a queue manager from Amazon, for example).

Install Project:

1) Clone Project from GIT
2) Run Migrations : php artisan migrate
3) Run Seeders: php artisan db:seed (This part will take some time; I processed a large amount of data)
4) Run Laravel: php artisan serve
5) Run: npm run  dev -> to run Node
6) As the project has a queue to process, to see how it works, you need to leave laravel's queue processing running

>php artisan queue:work

Thanks for the opportunity
Wanessa Motta