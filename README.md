# laravel-demo

#in project user can register, login and update their basic details.
also user can create, update, delete own post.

#Using faker to add 50 blogs in the blog DB use command
-php artisan db:seed --class=PostSeeder

#delete blogs older than the last 30 days use command
-php artisan blogs:remove
