# Messagebox Backend

The backend of the Messagebox hardware (https://github.com/ChristianGreiner/messagebox-hardware)

## Current features

- Send messages
- Register your own device with a secret key
- Friendsystem
- Device options (Rotation, Polling interval, Roration interval)
- Mute your messagebox
- Messages decryption

## Installation

1. Clone this project
2. Install all laravel dependencies: `composer install`
3. Add Users: Edit the UserSeeder.php file in `database\seeders\UserSeeder.php`
4. Run database migration: `php artisan migrate:refresh --seed`

## Register Device

To register your messagebox, navigate to "Device" and type in the Hardware ID that your messagebox displays on the screen.
After some time, your messagebox should show "Device Registered" and should be ready for use.

## Screenshots

**Dashboard**

![screenshot01](https://user-images.githubusercontent.com/6233308/120904799-62119400-c64e-11eb-8ccb-8384f7cf9cce.jpg)

**Send new message**

![screenshot02](https://user-images.githubusercontent.com/6233308/120903587-38a13a00-c647-11eb-962a-9eb58618bdd6.jpg)


## Used Technologies

- Backend: https://laravel.com/
- Frontend: https://tabler.io/
