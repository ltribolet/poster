## About Poster

Poster is a self hosted gallery picture

## Prerequisites

You'll need :

- PHP 7.1
- MySQL/MariaDB
- ...

Or just use the docker setup included in the project if you want to check out.

So you'll need Docker and Docker-compose.

## Installing

By default domain name is : poster.dev

Add it to your hosts file :

```
127.0.0.1   poster.dev
```

This will be used in `docker/nginx/vhost.conf` and in `.env` files if you want to alter it.

If you're with Docker tools don't forget to enable port forwarding in Virtualbox setup.

So now you can clone repo and start docker :

```
git clone git@github.com:ltribolet/poster.git && cd poster
docker-compose up -d
docker-compose exec fpm bash
composer install # this is inside container
cp .env.example .env
php artisan key:generate # copy and paste this key in the APP_KEY section of the .env file
php artisan migrate
php artisan passport:install # copy credentials into .env at PERSONAL_CLIENT_SECRET and PASSWORD_CLIENT_SECRET
```

This will build all images and run the stack.

You'll be able to access : [poster.dev](http://poster.dev)

## Debug

- Nginx error log are accessible in fpm container at `/var/log/nginx/poster-error.log`
- Laravel log are accessible at `./storage/logs` 
