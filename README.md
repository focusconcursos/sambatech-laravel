# Sambatech Laravel

This is an unofficial Sambatech development kit for Laravel. You can upload videos easily and without any headache.

> Currently, only Laravel 5.5+ is supported.

Install the library:

```bash
composer require focusconcursos/sambatech-laravel
```

Then you can use the facade.

```php
use FocusConcursos\SambatechLaravel\Facades\Sambatech;

# ...

$pathToVideo = '/etc/chaves_s01_e02.mp4'; // Location on the server
$id = Sambatech::upload($pathToVideo); // ID of the video
```

# Roadmap

- [x] Video upload
- [ ] Audio upload
- [ ] Full CRUD operations on videos


*Pull requests are welcome!*

For further information, consult the Sambatech API documentation.
