<?php

// setup error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

// check PHP version
version_compare(PHP_VERSION, '5.3', '<') and exit('Paste requires PHP 5.3 or newer.');

// composer autoload
require 'vendor/autoload.php';
use Paste\Paste;

// configuration
$config = array(
	// optionally specify a 'base_url' if serving Paste from a subdirectory
	// 'base_url' => 'paste-demo',
	// relative path to content directory
	// 'content_dir' => 'content',
	// relative path to template directory
	// 'template_dir' => 'templates',
	// relative path to cache directory
	// 'cache_dir' => 'cache',
);

// load config and parse content directory
$paste = new Paste($config);

// (optional) user defined routing
// 'route regex' => any valid callback
// matched tokens from the regex will be passed as parameters, with $paste instance first
// e.g. 'blog/([A-Za-z0-9-_]+)' => 'function($paste, $slug) { ... }',
$paste->add_route('blog/([0-9]{4})/([0-9]{2})/([0-9]{2})/([A-Za-z0-9-_]+)', function($paste, $year, $month, $day, $name) {
	// strip date and run normal content request
	return $paste->render_url("blog/$name");
});

// init routing and run
$paste->run();
