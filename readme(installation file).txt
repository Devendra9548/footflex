Step 01: Create Database
Step 02: Set Database with .env file
Step 03: Run Below Command in CMD (After That Check 11 tables created Successfully)

php artisan migrate --path=database/migrations/2024_01_25_100122_create_blogs_categories_table.php
php artisan migrate --path=database/migrations/2024_01_25_070520_create_blogs_table.php
php artisan migrate --path=database/migrations/2024_01_30_052841_create_blog_seo_table.php
php artisan migrate

Step 04: Update create_at & updated_at  in tables 
         from DB (Convert into default timestamps)

Step 04: Create Blog Category First (For Default)

Step 05: create admin_info detail in admin_info table
         for login (note* password must be md5)

Step 06: php artisan serve and login 

Step 07: Inside Dashboard : Go to Admin Info and then click 
         to Save Changes (For Global SEO Settings)

Step 08: for page seo use correct slug name ( title is optional)

Step 09: Set SMTP settings from .env file



Additional Changes
--------------------------

Step 01 : if you font to change font-family with cdns
go to :: views > templates > front > ( inside changes all files)
