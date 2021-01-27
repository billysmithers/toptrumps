<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// uri ends with /
if (substr_compare($uri, '/', -1) === 0) {
    $uri .= 'index.html';
}

$path = __DIR__ . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'dist' . $uri;

if (is_file($path)) {
    header('Content-type: ');

    echo file_get_contents($path);
}
