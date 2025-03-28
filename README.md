# NuxG Starter
Sneat Vuetify Vuejs Laravel admin template

## Installation

Open the terminal in that directory & to install the composer packages, run the following command:
```sh
composer install
```

Run the following command to copy .env.example file content into .env file:
```sh
cp .env.example .env
```

Run the following command to generate the key (You can also edit your database credentials here):
```sh
php artisan key:generate
```
Edit your `.env` file
```env
APP_GAME_SERVICE=lucky
QUEUE_CONNECTION=sync
CACHE_STORE=file
```

Run the following command to run migrations and seeds:
```sh
php artisan migrate --seed
```

To serve the application you need to run the following command in the project directory. (This will give you an address with port number 8000)

Now navigate to the given address you will see your application is running:
```sh
php artisan serve
```
