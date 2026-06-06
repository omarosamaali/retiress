<?php
// Expire old events — DELETE after use
define('LARAVEL_START', microtime(true));
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$db = $app['db'];

$cutoff = '2026-06-01 00:00:00';

// Count before
$total = $db->table('events')->count();

// Update: set ends_at = June 1 for all events that started on or before June 1
// and don't already have an ends_at in the past
$affected = $db->table('events')
    ->where('starts_at', '<=', $cutoff)
    ->where(function ($q) use ($cutoff) {
        $q->whereNull('ends_at')
          ->orWhere('ends_at', '>', $cutoff);
    })
    ->update(['ends_at' => $cutoff]);

// Show results
$events = $db->table('events')
    ->orderBy('starts_at')
    ->get(['id', 'title_ar', 'starts_at', 'ends_at', 'price', 'status']);

echo '<pre style="font-family:monospace;direction:rtl;text-align:right;">';
echo "✅ تم تحديث {$affected} إعلان من أصل {$total}" . PHP_EOL . PHP_EOL;
echo str_pad('ID', 5) . str_pad('السعر', 12) . str_pad('تاريخ الانتهاء', 22) . str_pad('تاريخ البدء', 22) . 'العنوان' . PHP_EOL;
echo str_repeat('-', 100) . PHP_EOL;

foreach ($events as $e) {
    $price   = ($e->price === null || (int)$e->price === 0) ? 'مجاني' : $e->price . ' AED';
    $status  = $e->status ? 'فعال' : 'غير فعال';
    $expired = ($e->ends_at && $e->ends_at < date('Y-m-d H:i:s')) ? ' [منتهي]' : '';
    echo str_pad($e->id, 5)
        . str_pad($price, 12)
        . str_pad($e->ends_at ?? 'بدون', 22)
        . str_pad($e->starts_at ?? '—', 22)
        . mb_substr($e->title_ar, 0, 40) . $expired
        . PHP_EOL;
}

echo PHP_EOL . '⚠️ احذف هذا الملف بعد الاستخدام!' . PHP_EOL;
echo '</pre>';
