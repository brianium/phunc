<?php
namespace Brianium\Phunc\Functions;

/**
 * Require the functions module
 */
loadModule('Functions');

class PartialTest extends \PHPUnit_Framework_TestCase
{
    protected $testValue = 'test';

    public function test_partial_function_application()
    {
        $greeting = function($greet, $name) {
            return "$greet $name";
        };

        $hello = partial($greeting, 'Hello!');

        $this->assertEquals('Hello! Brian', $hello('Brian'));
    }

    public function test_partial_application_with_multiple_args()
    {
        $test = function($one, $two, $three) {
            return "$one $two $three";
        };

        $oneTwo = partial($test, "one", "two");

        $this->assertEquals("one two four", $oneTwo('four'));
    }

    public function test_partial_application_maintains_this_context()
    {
        $test = function($string) {
            return $string . $this->testValue;
        };

        $thisIsATest = partial($test, 'This is a ');

        $this->assertEquals('This is a ' . $this->testValue, $thisIsATest());
    }

    public function test_partial_application_of_empty_function()
    {
        $test = function() {
            return 'test';
        };

        $p = partial($test);

        $this->assertEquals('test', $p());
    }

    public function test_partial_with_string_function_name()
    {
        $string = 'brian';
        $fixed = partial('strlen', $string);
        $this->assertEquals(5, $fixed());
    }

    public function test_partial_with_object_specifier()
    {
        $name = ' brian';
        $fixed = partial([$this, 'sayHello'], $name);
        $this->assertEquals("hello!$name", $fixed());
    }

    public function test_partialRight_function_application()
    {
        $greeting = function($greet, $name) {
            return "$greet $name";
        };

        $greetBrian = partialRight($greeting, 'Brian');

        $this->assertEquals('Hello! Brian', $greetBrian('Hello!'));
    }

    /**
     * Test function for object based callbacks
     *
     * @param $name
     * @return string
     */
    public function sayHello($name)
    {
        return 'hello!' . $name;
    }
}