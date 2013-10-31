<?php
namespace Brianium\Phunc\Functions;

/**
 * Partially apply arguments to a callable type
 *
 * @param callable $func
 * @return callable
 */
function partial(callable $func /** args **/) {
    $rest = array_slice(func_get_args(), 1);
    return function() use ($func, $rest) {
        $args = array_merge($rest, func_get_args());
        return call_user_func_array($func, $args);
    };
}