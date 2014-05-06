<?php
namespace Brianium\Phunc\Functions;

class ComposeTest extends \PHPUnit_Framework_TestCase
{
    public function test_compose_passes_results_from_end_to_first()
    {
        $makeCool = function($name) {
            return $name . ' is cool.';
        };
        $subject = 'brian:scaturro';
        $findNameAndMakeItCool = compose($makeCool, 'ucfirst', partialRight('strstr', true, ':'));
        $result = $findNameAndMakeItCool($subject);
        $this->assertEquals('Brian is cool.', $result);
    }
}
