<?php

// Ensure APP_BASE_PATH is correct for Vercel environment.
if (! isset($_ENV['APP_BASE_PATH'])) {
    $_ENV['APP_BASE_PATH'] = dirname(__DIR__);
}

// Ensure Blade compiled views can write to /tmp on Vercel.
$viewCompiledPath = getenv('VIEW_COMPILED_PATH') ?: sys_get_temp_dir().'/views';
if (! is_dir($viewCompiledPath)) {
    mkdir($viewCompiledPath, 0777, true);
}

require __DIR__.'/../public/index.php';
