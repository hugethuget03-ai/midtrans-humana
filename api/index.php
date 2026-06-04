<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Get the base path - in Vercel it will be /var/task/user
$basePath = dirname(dirname(__FILE__));

if (file_exists($maintenance = $basePath.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

require $basePath.'/vendor/autoload.php';

// Ensure APP_BASE_PATH is correct for Vercel environment
if (!isset($_ENV['APP_BASE_PATH'])) {
    $_ENV['APP_BASE_PATH'] = $basePath;
}

try {
    $app = require_once $basePath.'/bootstrap/app.php';
    $app->handleRequest(Request::capture());
} catch (Throwable $e) {
    // If there's an error bootstrapping, return a simple error response
    http_response_code(500);
    header('Content-Type: text/plain');
    echo "Internal Server Error\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    if (env('APP_DEBUG')) {
        echo "\nStack Trace:\n";
        echo $e->getTraceAsString();
    }
}
