<?php

namespace test\Khalyomede;

use Khalyomede\Prototype;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use InvalidArgumentException;
use BadMethodCallException;

class PrototypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Prototype::class);
    }

    function it_should_prevent_prototyping_existing_function() {
    	$this->shouldThrow('InvalidArgumentException')->during('prototype', ['prototype', function() {
    		return 'prototype';
    	}]);
    }

    function it_should_prevent_adding_duplicate_prototypes() {
    	$this->prototype('foo', function() {
    		return 'foo';
    	});

    	$this->shouldThrow('InvalidArgumentException')->during('prototype', ['foo', function() {
    		return 'bar';
    	}]);
    }

    function it_should_prevent_calling_unregistered_prototypes() {
    	$this->shouldThrow('BadMethodCallException')->during('bar');
    }
}
