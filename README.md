# Blockpcito Layout

## Laravel backend Layout

This repo contains a frontend and bakend layouts for a laravel breeze  
Contains:
- Laravel 9
- Tailwind
- Livewire
- Alpine JS

Packages for laravel:
- [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar) (for only dev)
- [christophrumpel/missing-livewire-assertions](https://github.com/christophrumpel/missing-livewire-assertions)
- [spatie/laravel-permission](https://spatie.be/index.php/docs/laravel-permission)
- [yoeunes/toastr](https://github.com/yoeunes/toastr) 
- [intervention/image](http://image.intervention.io/)

Icons [blade-ui-kit/blade-icons](https://github.com/blade-ui-kit/blade-icons) with 
- [Boxicons](https://github.com/mallardduck/blade-boxicons)
- [Heroicos](https://github.com/blade-ui-kit/blade-heroicons)

_Dont forget clear cache icons_

Helpers: file autoload helper on `Blockpc\helpers.php`

Packages NPM: only one, [tailwind-scrollbar](https://github.com/adoxography/tailwind-scrollbar)

This packages includes a model `Profile` (one-to-one for user) and model `Image` (polimorphic model)

And change some components from the original laravel install.

### Create Packega

with command `php artisan blockpc:package` you can create your own packages folder with own service provider.
This command create a folder structure like this:
```
packages/
    - Package/
        - App/
            - config/
                - config.php
            - Http/
                - Controllers/
                    - PackageController.php
            - Providers/
                - PackageServiceProvider.php
        - resources/
            - views/
                - index.blade.php
        - routes/
            - web.php
```

This command create a service provider an config file.
_more information soon_

### Install Clone

- git clone https://github.com/blockpc/blockpcito your-proyect
- cd your-proyect
- cp .env.example .env (Configure your app name, app url, database, email, etc)
- composer install
- php artisan key:generate
- npm install
- npm run dev
- php artisan migrate --seed
- php artisan storage:link
- php artisan icons:cache
- php artisan test

_delete line `packages/` from `.gitignore`_

### Change remote (important)

You must before start your proyect remove or change the git remote url

- git remote set-url origin `url-at-your-proyect-git`
- git remote -v

Enjoy!