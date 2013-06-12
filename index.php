<?php

// shortcut
namespace Paste;

// setup error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

// check PHP version
version_compare(PHP_VERSION, '5.3', '<') and exit('Paste requires PHP 5.3 or newer.');

// composer autoload
require 'vendor/autoload.php';

// (optional) user defined routing
// 'route regex' => any valid callback
// matched tokens from the regex will be passed as parameters
// e.g. 'blog/([A-Za-z0-9-_]+)' => 'Class::method',
Paste::route('blog/([0-9]{4})/([0-9]{2})/([0-9]{2})/([A-Za-z0-9-_]+)', function($year, $month, $day, $name) { 
	// strip date and run normal content request
	Content::request("blog/$name");
});

// init routing and run
Paste::run();

