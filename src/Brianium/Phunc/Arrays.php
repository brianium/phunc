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