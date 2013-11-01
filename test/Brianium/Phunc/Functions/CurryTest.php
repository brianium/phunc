<?php
namespace Brianium\Phunc\Functions;
loadModule('Functions');

class CurryTest extends \PHPUnit_Framework_TestCase
{
    public function test_curry1_function()
    {
        $identity = function($a, $optional = 2) {
            return $a + $optional;
        };

        $curried = curry1($identity);

        $this->assertEquals(4, $curried(2));
    }

    public function test_curry2_function()
    {
        $string = 'brian:scaturro';

        $curried = curry2('strstr');
        $curried = $curried($string);

        $this->assertEquals(':scaturro', $curried(':'));
    }

    public function test_curry3_function()
    {
        $string = 'brian:scaturro';

        $curried = curry3('strstr');
        $curried = $curried($string);
        $curried = $curried(':');

        $this->assertEquals('brian', $curried(true));
    }

    public function test_curry_function_with_arity_arg()
    {
        $strtime = curry('microtime');
        $floattime = call_user_func(curry('microtime', 2), true);
        $strstrWithBrianAndColon = call_user_func(call_user_func(curry('strstr', 3), 'brian:scaturro'), ':');
        $this->assertTrue(is_string($strtime()));
        $this->assertTrue(is_float($floattime()));
        $this->assertEquals('brian', $strstrWithBrianAndColon(true));
    }

    public function test_curryRight_function_with_arity_arg()
    {
        $subject = 'brian:scaturro';

        $strstrBeforeNeedleWithColon = curryRight('strstr', 3);
        $strstrBeforeNeedleWithColon = $strstrBeforeNeedleWithColon(true);
        $strstrBeforeNeedleWithColon = $strstrBeforeNeedleWithColon(':');

        $strstrBeforeNeedle = curryRight('strstr', 2);
        $strstrBeforeNeedle = $strstrBeforeNeedle(true);


        $testValues = [4,5,6];
        $arrayToString = curryRight('implode');

        $this->assertEquals('brian', $strstrBeforeNeedleWithColon($subject));
        $this->assertEquals('brian', $strstrBeforeNeedle($subject, ':'));
        $this->assertEquals('456', $arrayToString($testValues));
    }
} 