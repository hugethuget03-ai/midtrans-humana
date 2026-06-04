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

// Create the view compiled path under /tmp so Vercel can write to it.
$viewCompiledPath = getenv('VIEW_COMPILED_PATH') ?: sys_get_temp_dir().'/views';
if (! is_dir($viewCompiledPath)) {
    mkdir($viewCompiledPath, 0777, true);
}

try {
    // Try to load the application
    $app = require_once $basePath.'/bootstrap/app.php';
    
    // Check if the app was created properly
    if (!($app instanceof Application)) {
        throw new RuntimeException('Application not properly instantiated');
    }

    // Ensure the view service is registered before handling requests.
    $app->register(\Illuminate\View\ViewServiceProvider::class);
    
    $app->handleRequest(Request::capture());
} catch (Throwable $e) {
    // If there's an error bootstrapping, return a simple error response
    http_response_code(500);
    header('Content-Type: text/plain');
    echo "Internal Server Error\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "Base Path: " . $basePath . "\n";
    echo "Bootstrap exists: " . (file_exists($basePath.'/bootstrap/app.php') ? 'YES' : 'NO') . "\n";
    echo "Vendor exists: " . (file_exists($basePath.'/vendor/autoload.php') ? 'YES' : 'NO') . "\n";
    echo "Config cache exists: " . (file_exists($basePath.'/bootstrap/cache/config.php') ? 'YES' : 'NO') . "\n";
    if (env('APP_DEBUG')) {
        echo "\nStack Trace:\n";
        echo $e->getTraceAsString();
    }
}
