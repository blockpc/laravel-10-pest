# Blockpcito Layout

## Laravel backend Layout

This repo contains a frontend and bakend layouts for a laravel breeze  
Contains:
- Laravel 10 (With vite)
- Tailwind
- Livewire
- Alpine JS

Packages for laravel:
- [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar) (for only dev)
- [christophrumpel/missing-livewire-assertions](https://github.com/christophrumpel/missing-livewire-assertions)
- [spatie/laravel-permission](https://spatie.be/index.php/docs/laravel-permission)
- [intervention/image](http://image.intervention.io/)

Icons [blade-ui-kit/blade-icons](https://github.com/blade-ui-kit/blade-icons) with  
- [Boxicons](https://github.com/mallardduck/blade-boxicons)
- [Heroicos](https://github.com/blade-ui-kit/blade-heroicons)

_Dont forget clear cache icons if don't see them correctly_

Helpers: file autoload helper on `Blockpc\helpers.php`

Packages NPM:  

- [tailwind-scrollbar](https://github.com/adoxography/tailwind-scrollbar)
- [aspect-ratio](https://github.com/tailwindlabs/tailwindcss-aspect-ratio)

This packages includes a model `Profile` (one-to-one for user) and model `Image` (polimorphic model)

And change some components from the original laravel install.

### Install Clone

first clone

    git clone https://github.com/blockpc/blockpcito _your-name-proyect_
    cd _your-name-proyect_
    cp .env.example .env (Configure your app name, app url, database, email, etc)
    composer install
    php artisan key:generate
    php artisan storage:link
    php artisan icons:cache

if not use SAIL

	php artisan migrate --seed
	npm install
	npm run dev
	open a new console
	php artisan test

else, with sail

	check if not docker-compose.yml exists
		php artisan sail:install (select your prefers apps, comma separator)
		you must change DB_HOST in your .env

	check VITE_PORT in docker-compose.yml `${VITE_PORT:-5173}:${VITE_PORT:-5173}`
	./vendor/bin/sail up -d
	./vendor/bin/sail php artisan migrate --seed
	check in phpunit.xml or add `<env name="DB_CONNECTION" value="sqlite"/>`
	./vendor/bin/sail npm install
	./vendor/bin/sail npm run dev
	open a new console
	./vendor/bin/sail php artisan test --stop-on-failure

### Change remote (important)

You must before start your proyect remove or change the git remote url

- git remote set-url origin `url-at-your-proyect-git`
- git remote -v

### Install PhpMyAdmin on Sail (optional)

`php artisan sail:install`  

if you wants install `phpmyadmin` for mysql/mariadb add at your `docker-compose.yml`  
and replace mariadb or mysql  

```
phpmyadmin:
    image: phpmyadmin/phpmyadmin:latest
    restart: always
    links:
        - mariadb:mariadb
    ports:
        - 8080:80
    environment:
        MYSQL_USERNAME: "${DB_USERNAME}"
        MYSQL_ROOT_PASSWORD: "${DB_PASSWORD}"
        PMA_HOST: mariadb
    networks:
        - sail
    depends_on:
        - mariadb
```

### Create Package

with command `php artisan blockpc:package` you can create your own packages folder with own service provider.
This command create a folder structure like this:
```
Packages/
    - Package/
        - App/
            - Http/
                - Controllers/
                    - PackageController.php
            - Models/
                - Package.php
            - Providers/
                - PackageServiceProvider.php
        - config/
            - config.php
        - database/
            - migrations/
                - 2022_06_02_140645_create_packages_table.php
        - lang/
            - en/
                - package.php
        - resources/
            - views/
                - index.blade.php
        - routes/
            - web.php
```
This command run `php artisan optimize --quiet`

Notes:  
- After add a new route in the web.php, you should run the command `php artisan route:clear`
- You must delete file `.gitignore` in packages folder  

_remember run `npm run dev` in development_

_this repository will always be up to date_

Enjoy!
