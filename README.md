# LaLess (Laravel4 Package)

LaLess is a Simple LESS compiler for Laravel 4 based on a PHP port (Less.php / oyejorge/less.php) of the official LESS processor <http://lesscss.org>.

## Quick start

### Required setup

In the `require` key of your `composer.json` app file add the following line:

    "berbecki/laless": "dev-master"

Then, run in terminal the Composer update comand:

    $ composer.phar update

In your `config/app.php` add line `'Berbecki\Laless\Laless\ServiceProvider'` to the end of the `$providers` array

    'providers' => array(

        'Illuminate\Foundation\Providers\ArtisanServiceProvider',
        'Illuminate\Auth\AuthServiceProvider',
        ...
        'Berbecki\Laless\Laless\ServiceProvider',

    ),

**You are ready to go!** Your application will now compile your LESS files when needed.

### Configuration (is optional but recommended)

By default, Laless will consider the directory `public/assets/less` as the input and `public/assets/css` for the output. But if you wish to change these values simply publish the package config files:

    $ php artisan config:publish berbecki/laless

and define the `origin` and `destination` keys in `config/packages/berbecki/laless/config.php`. For example:

    // config/packages/berbecki/laless/config.php

    // Paths should be relative to app folder.
    'origin'        => 'mylessfiles',
    'destination'   => '../public/mycss',

### Console usage

If for some reason you need to force the compilation of LESS files (ex: in production environment), its possible through the command:

    $ php artisan laless:compile

## License

Laless is a free software distributed under the terms of the MIT license

## Aditional information

If you have a questions, feel free to contact with me.
