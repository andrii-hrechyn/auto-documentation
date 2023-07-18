# Auto Documentation

Auto Documentation is a library for generating auto documentation for Laravel.

# What It Does
This package allows you to generate API documentation. Based on [OpenAPI 3](https://github.com/OAI/OpenAPI-Specification) and [Redoc](https://github.com/Redocly/redoc)

Once installed you can do stuff like this:

```php
// Create documentation for path
Path::get('/your/api/{endpoint}', 'Your endpoint name')
    ->group('Some group')
    ->tag('Some tag') // or ->tags(['First tag', 'Second tag'])
    ->parameters([
        PathParameter::make('endpoint')
            ->required()
            ->type(Type::string)
            ->example('myGoodEndpoint'),
    ])
    ->jsonRequest([
        StringProperty::make('some_property_name')->required()
            ->description('You can add description for each property'),
        BooleanProperty::make('one_more_property'),
    ])
    ->successfulResponse([
        StringProperty::make('message')->example('Success response'),
    ])
    ->secure();

// Or you can use existing schemas
Path::get('/your/api/endpoint', 'Your endpoint name')
    ->group('Some group')
    ->tag('Some tag') // or ->tags(['First tag', 'Second tag'])
    ->parameters([ExampleParameter::make()])
    ->jsonRequest(ExampleSchema::make())
    ->successfulResponse(ExampleSchema::make())
    ->secure();

//Also you can do that for routes
Route::make('name.of.your.route', 'Example route')
    ->group('Some other group')
    ->tag('Other tag')
    ->requestBodyFromRequestClass() // Get request body from validation rules in request class
    ->successfulResponse(ExampleSchema::make())
    ->secure();
```

## Installation

You can install the package via Composer:

```bash
composer require andrii-hrechyn/auto-documentation
```

Then you can run command:
```bash
php artisan auto-doc:install
```
This command create folder ```docs``` in your root folder with some examples of documentation.
Also, this command will add autoload to your composer.json
```
    ...
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            ...
            "Docs\\": "docs"
        }
    },
    ...
```
```docs``` folder contains all files related to documentation.
Folder structure:
```
├── Components
│   ├── Parameters
│   │   └── ExampleParameter.php
│   └── Schemas
│       ├── ExampleSchema.php
│       └── ExampleSubSchema.php
├── Paths
│   ├── testPaths.php
│   └── testRoute.php
└── info.php
```

```info.php``` contains general information about API (info, servers, security, default security and external docs link)

## Usage

For generate documentation run command:

```bash
php artisan auto-doc:generate
```
This command take info.php file and all paths from ```docs``` folder and generate ```documentation.yaml``` in ```storage/app/auto-docs```

## Configuration

...

## Testing

...

## License

This library is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Credits

- Developer: Andriy Hrechyn
- Email: andriy.hrechyn@gmail.com