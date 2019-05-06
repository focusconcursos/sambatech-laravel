# Sambatech Laravel

This is an unofficial Sambatech development kit for Laravel. You can upload videos easily and without any headache.

> Currently, only Laravel 5.5+ is supported.

Install the library:

```bash
composer require focusconcursos/sambatech-laravel
```

Publish the config file

```bash
php artisan vendor:publish --provider="FocusConcursos\SambatechLaravel\SambatechServiceProvider"
```

Fill in your `.env` with the credentials:

```dotenv
SAMBATECH_PROJECT_ID=
SAMBATECH_ACCESS_TOKEN=
```

Then you can use the facade.

```php
use FocusConcursos\SambatechLaravel\Facades\Sambatech;

# ...

$pathToVideo = '/var/www/html/uploads/chaves_s01_e02.mp4';
$metadata = [
    'title' > 'Video title',
    'description' => 'Full video description'
    'shortDescription' => 'Short video description',
    'tags' => ['tag 01', 'tag 02']
];
$sambatechMediaId = Sambatech::upload($pathToVideo, $metadata);
```

# Roadmap

- [x] Video upload
- [ ] Audio upload
- [ ] Full CRUD operations on videos


*Pull requests are welcome!*

For further information, consult the Sambatech API documentation.
