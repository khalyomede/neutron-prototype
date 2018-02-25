<?php
	require( __DIR__ . '/../vendor/autoload.php' );

	use Khalyomede\Prototype;

	/**
	 * This is an example class
	 */
	class Tableau extends Prototype {
		public $items;

		public function __construct($items = []) {
			$this->items = $items;
		}

		public function all() {
			return $this->items;
		}
	}

	$tableau = new Tableau(['php' => '7.2', 'python' => '3.6', 'nodejs' => '8.9']);
	$all_items = $tableau->all();

	print_r($all_items);

	/**
	 * ['php' => '7.2', 'python' => '3.6', 'nodejs' => '8.9']
	 */

	$tableau->prototype('find', function($name) {
		return isset($this->items[$name]) ? $this->items[$name] : null;
	});

	$php_found = $tableau->find('python');

	print_r($php_found);

	/**
	 * '3.6'
	 */
?>