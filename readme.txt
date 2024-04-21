Step 01: Create Database
Step 02: Set Database with .env file
Step 03: Run Below Command in CMD

php artisan migrate --path=database/migrations/2024_01_25_100122_create_blogs_categories_table.php
php artisan migrate --path=database/migrations/2024_01_25_070520_create_blogs_table.php
php artisan migrate --path=database/migrations/2024_01_30_052841_create_blog_seo_table.php
php artisan migrate


Step 04: Update create_at & updated_at  in tables 
         from DB (Convert into default timestamps)

Step 04: Create Blog Category First (For Default)

Step 05: Set SMTP settings from .env file