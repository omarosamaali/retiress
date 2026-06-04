<?php
// Temporary cache-clear script — DELETE after use
define('LARAVEL_START', microtime(true));
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->call('view:clear');
$kernel->call('cache:clear');
$kernel->call('config:clear');
echo '<pre>✅ view:clear done' . PHP_EOL;
echo '✅ cache:clear done' . PHP_EOL;
echo '✅ config:clear done' . PHP_EOL;
echo 'Delete this file now!</pre>';
