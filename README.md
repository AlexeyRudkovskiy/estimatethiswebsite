# Estimate This Website

## Packages:

This project use next packages:

- Laravel
- Fuse theme (angular)

## Frontend

On Frontend we use Fuse theme (Angular version). Yo build frontend, you need to follow this steps:

### Install dependencies:

```npm install```

### Start in development mode

You can launch frontend independently. To do this, please run next command:

```ng start```

### Build frontend

```ng build```

This command will create js and css bundles and place them under ``public`` folder 

## Backend

To setup backend, you need to install composer dependencies via this command:

```composer install```

Then, you need to create .env file:

```cp .env.example .env```

The, you need to fill needed keys and credentials in .env file. You can do this by editing .env file in any editor you prefer.

You **MUST** to provide correct database credentials!

Then, you need to generate application key by running this command:

```php artisan key:generate```

After this step, you can create tables in database:

```php atisan migrate```

