
## 2.0.0

__Breaking Changes__

- `path_images` is now `path_web`, the value that goes inside is the same as before
- `path_images_root` is now `path_local`, the value is now the absolute path to the images directory

__Other__

- Added support for Slim 3

## 1.2.1 Retina Support

- Fixed retina images support, is now fully tested and integrated
- Improved documentation

## 1.2.0 Laravel 5 Support

- PHP 5.5 is the new minimum version
- Laravel 5 is now supported
- Laravel 4 is still supported
- Added integration tests for Laravel 5


## 1.1.0 Test all the things

__Major changes__

- We use imagine/imagine to generate images instead of raw GD
- Minimum PHP version is now 5.4

__Fixes__

- Fix incorrect headers

__Tests__

- Decent code coverage
- Integration tests with Slim and with Laravel


## 1.0.0 First Release

__Works with__

- Laravel 4
- Slim 2
- Raw PHP

__Features__

- Completely configurable
- Already generated images are served by the web server, not PHP
- Support retina images and retina specific presets