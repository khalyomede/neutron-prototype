# Neutron\Prototype

Enable adding method to a class on the fly.

## Summary
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Examples of uses](#examples-of-uses)
- [Licence MIT](#licence)

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
composer require neutron/prototype:1.*
```

## Examples of uses

All these examples can be seen in `/example` folder.

- [Example 1 : extending a class with a simple function](#example-1--extending-a-class-with-a-simple-function)
- [Example 2 : extending a class with a simple method](#example-2--extending-a-class-with-a-simple-method)
- [Example 3 : extending a class with a method with parameters](#example-3--extending-a-class-with-a-method-with-parameters)

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

### Example 1 : extending a class with a simple function

```php
use Me\Tableau;

$languages = ['php' => '7.2', 'python' => '3.6', 'nodejs' => '8.6']

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

## Licence MIT

Neutron Prototype

Copyright © 2018 Khalyomede

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.