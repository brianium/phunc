<?php
namespace Brianium\Phunc\Arrays;

/**
 * Return all array entries but the first
 *
 * @param array $array
 * @return array
 */
function rest(array $array) {
    return array_slice($array, 1);
}

/**
 * Concat all supplied arrays
 *
 * @return array|mixed
 */
function concat(/** arrays **/) {
    $arrays = array_filter(func_get_args(), 'is_array');
    return call_user_func_array('array_merge', $arrays);
}
