<?php


/**
 * Bootstrap the application, include vendor dependencies.
 */
require 'vendor/autoload.php';
require './OgQuery.php';

/**
 * Get the URL you'd like to check.
 */
$url = $_GET['url'] ?? false;

if(!$url) {
    return false;
}

/**
 * Fire up the query class.
 */

$Query = new OgQuery();

var_dump($Query->endpoint($url)
    ->meta_tags([
        'og:title'
    ])
    ->execute());