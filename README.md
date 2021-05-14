# Dogebank

A playground project representing a bank that does the following:

* Add new branches.
* Add new customers with a starting balance.
* Transfer a sum of money between any two customers.
* Show all branches along with the highest balance at each branch.
* List just those branches that have more than two customers with a balance over 50,000.

## Setup

This project uses Laravel Sail for running in local, to use it, please do the following:

**Set env file**

```
cp .env.example .env
```

**Install composer dependencies**

```
docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/opt -w /opt laravelsail/php80-composer:latest composer install --ignore-platform-reqs
```

**Start environment**

```
./vendor/bin/sail up -d
```

**Run migrations**

```
./vendor/bin/sail artisan migrate
```

**Run tests**

WARNING: This will remove current database data

```
./vendor/bin/sail test
```

**Build frontend**

```
./vendor/bin/sail npm run dev
```

or

```
./vendor/bin/sail npm run prod
```

After setting up and starting the containers, the site will be accessible at http://localhost (port 80)

## Architecture

This project uses a simplified DDD approach with Hexagonal Architecture. It assumes that all the application is a single Bounded Context (Dogebank).

All the modules from the Bounded Context can be found under the /src folder. The app folder (Laravel app) is considered Infrastructure.


