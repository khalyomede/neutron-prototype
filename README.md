# Prototype

![PHP from Packagist](https://img.shields.io/packagist/php-v/khalyomede/prototype.svg)
![Packagist](https://img.shields.io/packagist/v/khalyomede/prototype.svg)
![Packagist](https://img.shields.io/packagist/l/khalyomede/prototype.svg)


Enable adding method to a class on the fly.

```php
class Tableau extends Prototype {
  public $items;

  public function __construct($items = []) {
    $this->items = $items;
  }
}
```

```php
$tableau = new Tableau(['php', 'python', 'nodejs']);

$tableau->prototype('all', function() {
  return $this->items;
});

$languages = $tableau->all();
```

## Summary
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Examples of uses](#examples-of-uses)
- [Methods definition](#methods-definition)
- [MIT licence](#mit-licence)

## Prerequisites

This project is bounded to the following requirements you should be aware of:
- PHP >= 7.0.0
- Each class extending `Prototype` should not define the `__call` method
- Each class extending `Prototype` should not define the following method: `prototype()`
- Each class extending `Prototype` should not define the following static method: `prototypes()`
- Each properties you want your end developper to access via prototyping should be declared as `public` (and not `protected`)
- Each methods you want your end developper to access via prototyping should be declared as `public` (and note `private`)

## Installation

On your project folder, open a command prompt and type: 
```bash
composer require khalyomede/prototype:1.*
```

## Examples of uses

All these examples can be seen in `/example` folder.

- [Example 1: extending a class with a simple function](#example-1-extending-a-class-with-a-simple-function)
- [Example 2: extending a class with a simple method](#example-2-extending-a-class-with-a-simple-method)
- [Example 3: extending a class with a method with parameters](#example-3-extending-a-class-with-a-method-with-parameters)

For all these examples, we will assume we have a function called `Tableau` that simulate the behavior of PHP collections:

```php
namespace Me;

use Neutron\Prototype;

class Tableau extends Prototype {
  public $items

  public function __construct($items = []) {
    $this->items = $items;
  }

  public function all() {
    return $this->items;
  }
}
```

### Example 1: extending a class with a simple function

```php
use Me\Tableau;

$languages = ['php' => '7.2', 'python' => '3.6', 'nodejs' => '8.6'];

$tableau = new Tableau($languages);

$tableau->prototype('className', function() {
  return 'Tableau';
});

echo $tableau->className();
```

Will display:

```bash
Tableau
```

### Example 2: extending a class with a simple method

```php
use Me\Tableau;

$languages = ['php' => '7.2', 'python' => '3.6', 'nodejs' => '8.6'];

$tableau = new Tableau($languages);

$tableau->prototype('first', function() {
  return $this->items[key($this->items)];
});

$version = $tableau->first();

echo $version;
```

Will print:

```bash
7.2
```

### Example 3: extending a class with a method with parameters

```php
use Me\Tableau;

$languages = ['php' => '7.2', 'python' => '3.6', 'nodejs' => '8.6'];

$tableau = new Tableau($languages);

$tableau->prototype('find', function($key) {
  return isset($this->items[$key]) ? $this->items[$key] : null;
});

$python_version = $tableau->find('python');

echo $python_version;
```

Will echo:

```bash
3.6
```

## Methods definition

- [prototypes()](#prototypes)
- [prototype()](#prototype)

### Prototypes()

List all the registered prototypes. The list is shared across all the instance of your prototyped object.

```php
public static function prototypes(): array
```

### Prototype()

Register a new method for the object. This method can then be accessed across all your instances of the prototyped object.

```php
public function prototype(string $name, callable $function): Prototype
```

**Exceptions**

`InvalidArgumentException`: 

- If the name of the function is already used by the prototyped object
- If the prototype has already been registered for this object

`BadMethodCallException`:

- If the method (you thought you prototyped) has not been registered yet

**Note**

This function returns an instance of the current object.

## MIT licence

Prototype

Copyright © 2018 Khalyomede

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.