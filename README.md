# Laravel Enum on steroids

This package provides Enum trait to speed up the development of Laravel applications.

## Requirements
- Laravel 9.0 or later.
- PHP 8.1 or later.

## Installation
Install via composer:
```bash
composer require everully/laravel-enum-on-steroids
````

# Usage
Add the `EnumOnSteroids` trait to your Enum class to add some useful methods.

```php
use Everully\LaravelEnumOnSteroids\EnumOnSteroids;

enum StringEnum: string
{
    use EnumOnSteroids;

    case A = 'a';
    case B = 'b';
    case C = 'c';
}
```

## Available methods

### Equals
Check if the enum is equal to another enum or a string.
```php
StringEnum::A->equals(StringEnum::A); // true

StringEnum::A->equals('a'); // true

StringEnum::A->equals(AnotherEnum::A); // false

StringEnum::A->equals('d'); // false
```

### Values
Return an array all the values of the enum.
```php
StringEnum::values(); // ['a', 'b', 'c']
```

### Names
Return an array of all the names of the enum.
```php
StringEnum::names(); // ['A', 'B', 'C']
```

### Collection
Return a Laravel collection of all the values of the enum.
```php
StringEnum::collection();
// Illuminate\Support\Collection<StringEnum>
```

### Collect
Return a Laravel collection of all the values of the enum.
```php
StringEnum::collect(['a', 'b', 'c']);
// Illuminate\Support\Collection<StringEnum>

StringEnum::collect([StringEnum::A, StringEnum::B, StringEnum::C]);
// Illuminate\Support\Collection<StringEnum>
```

If provided string or object is not a valid enum value, the collection will not contain it.
```php
StringEnum::collect(['a', 'invalid']);
// Only contains 'a'

StringEnum::collect([StringEnum::A, AnotherEnum::B]);
// Only contains 'a'
```
