# README #

## # Installation

Register the Media Manager service provider in the `providers` array of your `config/app.php` configuration file:
```php
MrTaiw\MediaManager\TwMediaManagerServiceProvider::class,
```
and alias
```php
'MediaManager' => MrTaiw\MediaManager\MediaManager::class,
```
publish vendor
```bash
php artisan vendor:publish --tag=twmm_config
```