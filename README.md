<img src="/public/assets/wisatix-sneak-peek.png" alt="Wisatix sneak peek">

## Wisatix

Wisatix is a mobile-first web app for booking tourism tickets, built using Laravel and Filament. It follows a modern development approach by implementing the service repository pattern.

## Installation

To get started with Wisatix, follow these steps:

```bash
# clone repository
git clone https://github.com/diosetiad/wisatix.git

# navigate into project directory
cd wisatix

# remove existing remote
git remote remove origin

# install PHP dependencies
composer install

# install Javascript dependencies
npm install

# copy .env example file to .env
cp .env.example .env

# set specific app url in .env
APP_URL=http://127.0.0.1:8000

# create database ex: wisatix, then put it in .env
DB_DATABASE=wisatix

# add inbox on Mailtrap for email testing, ex: Wisatix
Wisatix

# get Mailtrap SMPT username and password credentials, then put in in .env
MAIL_USERNAME= "your username credential"
MAIL_PASSWORD= "your password credential"

# generate new application key
php artisan key:generate

# run migrations
php artisan migrate

# start development server
npm run dev
php artisan serve

# recreate symbolic link
php artisan storage:link

# start jobs for email delivery, complete your ticket order and check your Mailtrap inboxes
php artisan queue:work
```
