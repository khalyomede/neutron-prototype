<?php
	/*
	* Neutron Prototype
	*
	* Copyright © 2018 Khalyomede
	*
	* Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
	*
	* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
	* 
	* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
	*/
	
	namespace Neutron;

	use InvalidArgumentException;
	use BadMethodCallException;

	class Prototype {
		/**
		 * @var array
		 */
		protected static $prototypes;

		/**
		 * @return array
		 */
		public static function prototypes(): array {
			return array_keys((array) static::$prototypes);
		}

		/**
		 * @param string $name
		 * @param callable $function
		 * @return Prototype
		 * @throws InvalidArgumentException
		 */
		public function prototype(string $name, callable $function) {
			$existing_methods = array_map(function($item) {
				return strtolower($item);
			}, get_class_methods($this));

			if( in_array(strtolower($name), $existing_methods) ) {
				throw new InvalidArgumentException(sprintf('Prototype::prototype : cannot register method "%s" because it already exists', $name));
			}

			if( isset(static::$prototypes[$name]) ) {
				throw new InvalidArgumentException(sprintf('Prototype::prototype : prototype "%s" already registered', $name));
			}

			static::$prototypes[$name] = $function;

			return $this;
		}

		/**
		 * @param string $method
		 * @param array $arguments
		 */
		public function __call($method, $arguments) {
			if( ! isset(static::$prototypes[$method]) ) {
				throw new BadMethodCallException(sprintf('Prototype:: : method "%s" has not been registered yet', $method));
			}

			return call_user_func_array(static::$prototypes[$method]->bindTo($this), $arguments);
		}
	}
?>