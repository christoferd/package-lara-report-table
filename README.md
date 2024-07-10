# My private package: package-lara-report-table

## Installation

```bash
composer require christoferd/package-lara-report-table
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="package-lara-report-table-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="package-lara-report-table-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="package-lara-report-table-views"
```

## Usage

```php
$laraReportTable = new Christoferd\LaraReportTable();
...
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

(c) Christoferd - Mindflow
