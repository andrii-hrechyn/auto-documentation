# Auto Documentation

A fluent, object-oriented library for generating OpenAPI 3.1.0 documentation in Laravel applications.

![PHP 8.3+](https://img.shields.io/badge/PHP-8.3%2B-blue)
![Laravel 7-11](https://img.shields.io/badge/Laravel-7--11-red)
![License: MIT](https://img.shields.io/badge/License-MIT-green)

## Introduction

Auto Documentation lets you describe your API endpoints as PHP classes using a fluent builder API. The library auto-discovers your documentation classes, resolves reusable components via `$ref`, and generates a complete OpenAPI 3.1.0 specification as YAML — viewable through a built-in Redoc UI.

Key features:

- **Fluent PHP API** — describe paths, schemas, parameters, and responses with method chaining
- **Auto-discovery** — path and component classes are automatically found and registered
- **Reusable components** — schemas, parameters, requests, and responses are deduplicated via `$ref`
- **Laravel integration** — built-in artisan commands, route-based request body extraction, Sanctum auth support
- **OpenAPI 3.1.0** compliant output

## Requirements

- PHP 8.3+
- Laravel 7, 8, 9, 10, or 11

## Installation

Install via Composer:

```bash
composer require andrii-hrechyn/auto-documentation
```

Run the install command to scaffold the `docs/` folder with examples and register the `Docs\\` namespace in your `composer.json` autoload:

```bash
php artisan auto-doc:install
```

This creates the following structure:

```
docs/
├── Components/
│   ├── Parameters/
│   ├── Requests/
│   ├── Responses/
│   ├── Schemas/
│   └── Security/
├── Paths/
└── Documentation.php
```

## Quick Start

### 1. Define your Documentation class

```php
// docs/Documentation.php
namespace Docs;

use AutoDocumentation\BaseDocumentation;
use AutoDocumentation\Info;

class Documentation extends BaseDocumentation
{
    protected function info(): Info
    {
        return Info::make('My API', '1.0.0')
            ->description('API documentation');
    }
}
```

### 2. Create a path component

```php
// docs/Paths/UsersPath.php
namespace Docs\Paths;

use AutoDocumentation\Base\PathComponent;
use AutoDocumentation\Paths\Method;
use AutoDocumentation\Paths\Path;
use AutoDocumentation\Properties\IntegerProperty;
use AutoDocumentation\Properties\StringProperty;

class UsersPath extends PathComponent
{
    public function path(): Path
    {
        return $this->make('users');
    }

    public function get(Method $method): Method
    {
        return $method
            ->operationId('listUsers')
            ->summary('List all users')
            ->tag('Users')
            ->jsonResponse([
                IntegerProperty::make('id')->example(1),
                StringProperty::make('name')->example('John'),
                StringProperty::make('email')->format('email'),
            ]);
    }
}
```

### 3. Generate documentation

```bash
php artisan auto-doc:generate
```

The specification is written to `storage/app/auto-docs/documentation.yaml` and served at `/api/doc`.

## Documentation Class

The `Documentation` class extends `BaseDocumentation` and serves as the entry point for your API spec. It has one required method and several optional ones.

### Info (required)

```php
protected function info(): Info
{
    return Info::make('Blog Platform API', '2.0.0')
        ->description('API documentation for the Blog Platform')
        ->termsOfService('https://example.com/terms')
        ->contact(
            (new Contact())
                ->name('API Support')
                ->email('support@example.com')
                ->url('https://example.com/support')
        )
        ->license(
            License::make('MIT')
                ->url('https://opensource.org/licenses/MIT')
        );
}
```

### Servers

```php
protected function servers(): array
{
    return [
        Server::make('https://api.example.com/{version}')
            ->description('Production server')
            ->variable(
                Variable::make('version', 'v2')
                    ->enum(['v1', 'v2'])
                    ->description('API version')
            ),
    ];
}
```

### Default Security

Set a global security scheme applied to all operations:

```php
protected function defaultSecuritySchema(): ?SecurityRequirement
{
    return SanctumAuth::make();
}
```

### Tags, Extensions & Tag Groups

Use `additionalOptions()` to define tags, vendor extensions, and external docs:

```php
public function additionalOptions(): void
{
    $this->openApi->externalDocs(
        ExternalDocs::make('https://example.com/docs')
            ->description('Full developer documentation')
    );

    $this->openApi->tag(
        (new Tag())->name('Users')->description('User management operations')
    );
    $this->openApi->tag(
        (new Tag())->name('Posts')->description('Blog post operations')
    );

    // Vendor extensions
    $this->openApi->extension('x-api-id', 'my-api');
}
```

### Groups

Groups organize tags into sections (rendered as `x-tagGroups` in the spec, supported by Redoc). Instead of defining groups manually, set a group on each path — tags are collected and grouped automatically:

```php
class PostsPath extends PathComponent
{
    public function path(): Path
    {
        return $this->make('posts')
            ->group('Content');  // all tags from this path go into the "Content" group
    }

    public function get(Method $method): Method
    {
        return $method->tag('Posts')->summary('List posts');
    }
}
```

Paths sharing the same group name have their tags merged into a single `x-tagGroups` entry.

## Paths

### PathComponent (recommended)

Path components are auto-discovered from the `docs/Paths/` directory. Extend `PathComponent` and define HTTP methods as class methods:

```php
class PostPath extends PathComponent
{
    public function path(): Path
    {
        return $this->make('posts/{postId}')
            ->parameter(
                Parameter::make('postId', ParameterIn::PATH)
                    ->description('The post ID')
                    ->required()
                    ->example(42)
            );
    }

    public function get(Method $method): Method
    {
        return $method
            ->operationId('getPost')
            ->summary('Get a post by ID')
            ->tag('Posts')
            ->response(
                SuccessfulResponse::make()->content([
                    ApplicationJson::make(PostSchema::make()),
                ])
            );
    }

    public function delete(Method $method): Method
    {
        return $method
            ->operationId('deletePost')
            ->summary('Delete a post')
            ->tag('Posts')
            ->response(NoContentResponse::make());
    }
}
```

Supported HTTP methods: `get`, `post`, `put`, `patch`, `delete`, `head`, `options`. Only define the methods your endpoint supports — the rest are omitted automatically.

### AuthPathComponent

Extends `PathComponent` and automatically applies Sanctum security to all methods:

```php
class AuthPath extends AuthPathComponent
{
    public function path(): Path
    {
        return $this->make('auth/login');
    }

    public function post(Method $method): Method
    {
        return $method
            ->operationId('login')
            ->summary('Authenticate and receive a token')
            ->tag('Auth')
            ->jsonRequest([
                StringProperty::make('email')->required()->format('email'),
                StringProperty::make('password')->required()->format('password'),
            ])
            ->jsonResponse([
                StringProperty::make('token')->example('1|abc123def456'),
                StringProperty::make('token_type')->default('Bearer'),
            ]);
    }
}
```

### Route-based paths

Reference existing Laravel routes by name and extract request bodies from form request validation rules:

```php
Route::make('posts.store', 'Create a new post')
    ->tag('Posts')
    ->requestBodyFromRequestClass()
    ->successfulResponse(PostSchema::make())
    ->secure();
```

### Method options

Methods support the full OpenAPI operation spec:

```php
$method
    ->operationId('updatePost')
    ->summary('Update a post')
    ->description('Full description here')
    ->tag('Posts')                                      // or ->tag((new Tag())->name('Posts'))
    ->deprecated()
    ->externalDocs(ExternalDocs::make('https://...'))
    ->extension('x-sunset', '2025-12-31')
    ->security(ApiKeyAuth::make())                      // per-operation security override
    ->request($request)
    ->response($response);
```

## Properties

Properties describe individual fields within schemas and request/response bodies. All properties use `make(string $name)` and support method chaining.

| Class | Type | Extra methods |
|---|---|---|
| `StringProperty` | `string` | `minLength()`, `maxLength()` |
| `IntegerProperty` | `integer` | `minimum()`, `maximum()` |
| `NumberProperty` | `number` | `minimum()`, `maximum()` |
| `BooleanProperty` | `boolean` | — |
| `ArrayProperty` | `array` | `minItems()`, `maxItems()` |
| `ObjectProperty` | `object` | — |
| `DateTimeProperty` | `string` (format: `date-time`) | `minLength()`, `maxLength()` |
| `FileProperty` | `string` (format: `binary`) | `minLength()`, `maxLength()` |

Common methods available on all properties: `required()`, `description()`, `example()`, `enum()`, `default()`, `format()`, `title()`, `extension()`.

```php
// Examples
StringProperty::make('title')->required()->maxLength(255)->example('My Post'),
IntegerProperty::make('id')->example(42),
StringProperty::make('status')->enum(['draft', 'published', 'archived'])->default('draft'),
DateTimeProperty::make('created_at'),
ArrayProperty::make('tag_ids', IntegerSchema::make()),
```

## Schemas

Schemas define the structure of data objects and are used inside properties, request bodies, and responses.

### ObjectSchema

```php
ObjectSchema::make([
    IntegerProperty::make('id')->example(1),
    StringProperty::make('name')->required(),
    StringProperty::make('email')->format('email'),
]);
```

### ArraySchema

```php
// Array of primitives
ArraySchema::make(IntegerSchema::make())->minItems(1);

// Array of objects
ArraySchema::make(
    ObjectSchema::make([
        StringProperty::make('title'),
    ])
);
```

### Primitive Schemas

`StringSchema`, `IntegerSchema`, `NumberSchema`, `BooleanSchema` — used as items for `ArraySchema` or `ArrayProperty`.

## Reusable Components

Components are self-registering classes that output `$ref` references in the generated spec. Extend the appropriate base class and implement the `content()` method.

### SchemaComponent

```php
class PostSchema extends SchemaComponent
{
    public function content(): ObjectSchema
    {
        return $this->schema([
            IntegerProperty::make('id')->example(42),
            StringProperty::make('title')->required()->maxLength(255)->example('My First Post'),
            StringProperty::make('body')->required(),
            StringProperty::make('status')->enum(['draft', 'published', 'archived'])->default('draft'),
            IntegerProperty::make('author_id')->example(1),
            ArrayProperty::make('comment_ids', IntegerSchema::make()),
            DateTimeProperty::make('published_at'),
            DateTimeProperty::make('created_at'),
        ])->extension('x-model', 'App\\Models\\Post');
    }
}
```

Usage: `PostSchema::make()` — returns a `$ref` to `#/components/schemas/PostSchema`.

### ParameterComponent

```php
class PageParameter extends ParameterComponent
{
    public function content(): Parameter
    {
        return $this->parameter('page', ParameterIn::QUERY)
            ->description('Page number for pagination')
            ->example(1);
    }
}
```

Usage: `PageParameter::make()` — returns a `$ref` to `#/components/parameters/PageParameter`.

### RequestComponent

```php
class CreatePostRequest extends RequestComponent
{
    public function content(): Request
    {
        return $this->request()
            ->required()
            ->description('Data for creating a new blog post')
            ->content([
                ApplicationJson::make(
                    ObjectSchema::make([
                        StringProperty::make('title')->required()->maxLength(255),
                        StringProperty::make('body')->required(),
                        StringProperty::make('status')->enum(['draft', 'published'])->default('draft'),
                    ])
                ),
            ]);
    }
}
```

### ResponseComponent

```php
class UnauthorizedResponse extends ResponseComponent
{
    public function content(): Response
    {
        return $this->response(401)
            ->description('Unauthenticated')
            ->content([
                ApplicationJson::make(ErrorSchema::make()),
            ]);
    }
}
```

## Parameters

Parameters are created with a name and location (`ParameterIn` enum):

```php
use AutoDocumentation\Enums\ParameterIn;

// Inline parameter
Parameter::make('postId', ParameterIn::PATH)
    ->description('The post ID')
    ->required()
    ->example(42);

// Query parameter
Parameter::make('search', ParameterIn::QUERY)
    ->description('Search term')
    ->example('laravel');

// Header parameter
Parameter::make('Accept-Language', ParameterIn::HEADER)
    ->description('Preferred language')
    ->example('en-US');

// Cookie parameter
Parameter::make('session', ParameterIn::COOKIE)
    ->description('Session identifier');
```

Attach parameters to a path:

```php
$this->make('posts')
    ->parameter(PageParameter::make())
    ->parameter(PerPageParameter::make());
```

## Request Bodies

### JSON request (shorthand)

Use `jsonRequest()` on a method for a quick JSON body:

```php
$method->jsonRequest([
    StringProperty::make('title')->required()->maxLength(255),
    StringProperty::make('body')->required(),
]);
```

Or pass a schema directly:

```php
$method->jsonRequest(
    ObjectSchema::make([
        StringProperty::make('title')->required(),
    ])
);
```

### Multipart/form-data

For file uploads, use `MultipartFormData` content type:

```php
$method->request(
    Request::make()
        ->required()
        ->content([
            MultipartFormData::make(FileUploadSchema::make()),
        ])
);
```

### From Laravel validation rules

When using `Route::make()`, extract the request body directly from a form request class:

```php
Route::make('posts.store', 'Create a post')
    ->requestBodyFromRequestClass();
```

This inspects the controller method's type-hinted `Request` class and converts its `rules()` to an OpenAPI schema.

## Responses

### SuccessfulResponse

```php
SuccessfulResponse::make()          // 200
SuccessfulResponse::make(201)       // 201
    ->description('Post created')
    ->content([
        ApplicationJson::make(PostSchema::make()),
    ]);
```

### NoContentResponse

```php
NoContentResponse::make();          // 204
```

### JSON response (shorthand)

```php
$method->jsonResponse([
    StringProperty::make('token')->example('abc123'),
    StringProperty::make('token_type')->default('Bearer'),
]);
```

### Custom responses

```php
Response::make(422)
    ->name('ValidationError')
    ->description('Validation failed')
    ->content([
        ApplicationJson::make(ErrorSchema::make()),
    ]);
```

## Security

### Built-in: SanctumAuth

```php
use AutoDocumentation\Security\SanctumAuth;

// As global default
protected function defaultSecuritySchema(): ?SecurityRequirement
{
    return SanctumAuth::make();
}

// Per-operation
$method->security(SanctumAuth::make());
```

### HTTP Security Scheme

```php
HttpSecurityScheme::make('bearer')
    ->bearerFormat('JWT')
    ->description('JWT Bearer token');
```

### API Key

```php
use AutoDocumentation\Enums\ApiKeySecuritySchemeIn;

ApiKeySecurityScheme::make('X-API-Key', ApiKeySecuritySchemeIn::HEADER)
    ->description('API key passed in the X-API-Key header');
```

### OpenID Connect

```php
OpenIdConnectSecurityScheme::make('https://auth.example.com/.well-known/openid-configuration')
    ->description('OpenID Connect');
```

### Custom security component

Create a reusable security requirement:

```php
class ApiKeyAuth extends SecurityRequirement
{
    public function content(): SecurityScheme
    {
        return ApiKeySecurityScheme::make('X-API-Key', ApiKeySecuritySchemeIn::HEADER)
            ->description('API key passed in the X-API-Key header');
    }
}
```

Use it globally or per-operation:

```php
// Global
protected function defaultSecuritySchema(): ?SecurityRequirement
{
    return ApiKeyAuth::make();
}

// Per-operation override
$method->security(ApiKeyAuth::make());
```

## Configuration

Publish the config file with `php artisan vendor:publish --tag=auto-documentation-config`.

| Option | Default | Description |
|---|---|---|
| `generate_always` | `false` | Auto-regenerate the spec on every page load (dev only) |
| `environment` | `['local', 'development']` | Environments where documentation routes are registered |
| `routes.documentation` | `api/doc` | URL path for the Redoc UI |
| `routes.specification` | `api/doc/spec` | URL path for the raw OpenAPI YAML |
| `paths.source` | `base_path('docs')` | Directory containing your documentation classes |
| `paths.generated-doc` | `storage_path('app/auto-docs')` | Directory where the generated YAML is stored |

Environment variable `AUTO_DOCUMENTATION_GENERATE_ALWAYS` controls the `generate_always` option. `AUTO_DOCUMENTATION_SOURCE` controls the source docs path.

## Generation

### Artisan command

```bash
php artisan auto-doc:generate
```

Generates `documentation.yaml` from your `Documentation` class and all discovered path components.

### Auto-regeneration

Set `generate_always` to `true` (or `AUTO_DOCUMENTATION_GENERATE_ALWAYS=true` in `.env`) to regenerate the spec on every documentation page load. Useful during development.

### Routes

| Route | Description |
|---|---|
| `/api/doc` | Redoc documentation UI |
| `/api/doc/spec` | Raw OpenAPI YAML specification |

Routes are only registered in the environments listed in the `environment` config option.

## License

This library is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Credits

- Developer: Andriy Hrechyn
- Email: andriy.hrechyn@gmail.com
