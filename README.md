## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

### Clone the repository

    git clone https://github.com/hayknazaryann/currency-microservice.git

### Switch to the repo folder

    cd currency-microservice

### Install all the dependencies using composer

    composer install

### Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

### Generate a new application key

    php artisan key:generate

### Run the database migrations (**Set the database connection in .env before migrating**)
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate

### Start the local development server

    php artisan serve

You can now access the server at http://127.0.0.1:8000

Documentation http://127.0.0.1:8000/api/documentation






