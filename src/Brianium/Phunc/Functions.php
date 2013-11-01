<?php
namespace Brianium\Phunc\Functions;
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Arrays.php';

use Brianium\Phunc\Arrays as _array;

/**
 * Partially apply arguments to a callable type
 *
 * @param callable $func
 * @return callable
 */
function partial(callable $func /** args **/) {
    $rest = _array\rest(func_get_args());
    return function() use ($func, $rest) {
        return call_user_func_array($func, array_merge($rest, func_get_args()));
    };
}

/**
 * Partially apply arguments from the right
 *
 * @param callable $func
 * @return callable
 */
function partialRight(callable $func /** args **/) {
    $rest = _array\rest(func_get_args());
    return function() use ($func, $rest) {
        return call_user_func_array($func, array_merge(func_get_args(), $rest));
    };
}

/***************************************************
 * Curry Functions
 *
 * Curry functions are fixed at numbers
 * and exposed via curry(callable $n, $arity) because
 * it seems too complicated to make a one size fits
 * all, especially when it won't be used very often
 ***************************************************/

/**
 * Curry up to 1 argument
 *
 * @param callable $func
 * @return callable
 */
function curry1(callable $func) {
    return function() use ($func) {
        return call_user_func_array($func, func_get_args());
    };
}

/**
 * Curry up to 2 arguments from the left
 *
 * @param callable $func
 * @param int $order - 0 for left 1 for right
 * @return callable
 */
function curry2(callable $func, $order = 0) {
    return function($arg1) use ($func, $order) {
        return function() use ($func, $arg1, $order) {
            $args = ($order > 0) ? array_merge(func_get_args(), [$arg1]) : array_merge([$arg1], func_get_args());
            return call_user_func_array($func, $args);
        };
    };
}

/**
 * Curry up to 3 arguments from the left
 *
 * @param callable $func
 * @param int $order - 0 for left 1 for right
 * @return callable
 */
function curry3(callable $func, $order = 0) {
    return function($arg1) use ($func, $order) {
        return function($arg2) use ($func, $arg1, $order) {
            return function() use ($func, $arg1, $arg2, $order) {
                $args = ($order > 0) ? array_merge(func_get_args(), [$arg2, $arg1]) : array_merge([$arg1, $arg2], func_get_args());
                return call_user_func_array($func, $args);
            };
        };
    };
}

/**
 * Curry a function from the left based on it's arity
 *
 * @param callable $func
 * @param int $arity
 * @return bool|mixed
 */
function curry(callable $func, $arity = 1) {
    $fn = __NAMESPACE__ . '\\' . "curry$arity";
    return (function_exists($fn)) ? call_user_func($fn, $func) : false;
}

/**
 * Curry a function from the right based on it's arity
 *
 * @param callable $func
 * @param int $arity
 * @return bool|mixed
 */
function curryRight(callable $func, $arity = 1) {
    $fn = __NAMESPACE__ . '\\' . "curry$arity";
    return (function_exists($fn)) ? call_user_func_array($fn, [$func, 1]) : false;
}