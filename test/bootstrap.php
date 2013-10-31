<?php
if (!defined('DS'))
    define('DS', DIRECTORY_SEPARATOR);

$vendor = dirname(__DIR__) . DS . 'vendor';

require_once $vendor . DS . 'autoload.php';

define('SRC', dirname(__DIR__) . DS . 'src');

function loadModule($name) {
    $path = SRC . DS . 'Brianium' . DS . 'Phunc' . DS . "$name.php";
    require_once $path;
}