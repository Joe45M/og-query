<?php

/**
 * This file illustrates an applicable use for the OgQuery class.
 * See this file as a form of glue, not a requirement.
 */


/**
 * Bootstrap the application, include vendor dependencies.
 */
require 'vendor/autoload.php';

/**
 * Get the URL you'd like to check - should be a FQDN.
 */
$url = $_GET['url'] ?? false;

if(!$url) {
    return false;
}

/**
 * Fire up the query class.
 */
//
// use Src\OgQuery;
//
// $Query = new OgQuery();


\Joem\OgQuery::

/**
 * Get your meta tags.
 */
$result = $Query
    ->endpoint($url)
    ->meta_tags(['og:title', 'og:site_name', 'og:description'])
    ->execute();
