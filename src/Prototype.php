<?php
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