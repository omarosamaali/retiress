<?php

namespace App\Console\Commands;

use App\Models\MemberApplication;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FixMembershipStatuses extends Command
{
    protected $signature   = 'memberships:fix-statuses {--dry-run : اعرض فقط ولا تعدل}';
    protected $description = 'إصلاح حالات العضوية الخاطئة في قاعدة البيانات';

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');
        $now    = Carbon::now();

        $this->info($dryRun ? '[ وضع المعاينة - لن يتم تعديل أي شيء ]' : '[ وضع التطبيق الفعلي ]');
        $this->newLine();

        // ─── 1. منتهية التاريخ لكن status ليس '4' ───────────────────────────
        $toExpire = MemberApplication::whereNotNull('expiration_date')
            ->whereDate('expiration_date', '<', $now->toDateString())
            ->whereNotIn('status', ['4'])
            ->get();

        $this->line("── المنتهية بالتاريخ ولم يُحدَّث status إلى '4': <fg=yellow>{$toExpire->count()}</>");

        foreach ($toExpire as $app) {
            $this->line("   ID {$app->id} | {$app->full_name} | انتهت: {$app->expiration_date} | status: '{$app->status}'");
        }

        if (! $dryRun && $toExpire->isNotEmpty()) {
            $ids = $toExpire->pluck('id');
            MemberApplication::whereIn('id', $ids)->update(['status' => '4']);
            // حدث role المستخدمين المرتبطين
            $userIds = $toExpire->pluck('user_id')->filter();
            User::whereIn('id', $userIds)->update(['role' => 'مستخدم']);
            $this->info("   ✓ تم تحديث {$toExpire->count()} سجل → status = '4'");
        }

        $this->newLine();

        // ─── 2. مجددة (expiration_date مستقبلي) لكن status = '4' أو null/غير صحيح ──
        $validStatuses = ['0', '1', '2', '3'];

        $toActivate = MemberApplication::where(function ($q) use ($now) {
            $q->whereNull('expiration_date')
              ->orWhereDate('expiration_date', '>=', $now->toDateString());
        })->where(function ($q) use ($validStatuses) {
            $q->where('status', '4')                    // منتهية رغم أن التاريخ مستقبلي
              ->orWhereNotIn('status', array_merge($validStatuses, ['4'])) // قيمة غير متوقعة
              ->orWhereNull('status');
        })->get();

        $this->line("── مستقبلية التاريخ ولكن status خاطئ ('4' أو null أو غير معروف): <fg=red>{$toActivate->count()}</>");

        foreach ($toActivate as $app) {
            $exp = $app->expiration_date ? Carbon::parse($app->expiration_date)->format('Y-m-d') : 'بدون تاريخ';
            $this->line("   ID {$app->id} | {$app->full_name} | تنتهي: {$exp} | status: " . var_export($app->status, true));
        }

        if (! $dryRun && $toActivate->isNotEmpty()) {
            $ids = $toActivate->pluck('id');
            MemberApplication::whereIn('id', $ids)->update(['status' => '3']);
            // أعد role المستخدمين المرتبطين إلى عضو
            $userIds = $toActivate->pluck('user_id')->filter();
            User::whereIn('id', $userIds)->update(['role' => 'عضو']);
            $this->info("   ✓ تم تحديث {$toActivate->count()} سجل → status = '3' (فعالة)");
        }

        $this->newLine();

        // ─── 3. إحصاءات ختامية ──────────────────────────────────────────────
        $this->line('── إحصاءات member_applications ──');
        $stats = MemberApplication::selectRaw('status, COUNT(*) as cnt')
            ->groupBy('status')
            ->orderBy('status')
            ->pluck('cnt', 'status');

        $labels = ['0' => 'بانتظار الدفع', '1' => 'بانتظار التفعيل', '2' => 'بانتظار الموافقة', '3' => 'فعالة', '4' => 'منتهية'];
        foreach ($stats as $status => $cnt) {
            $label = $labels[(string)$status] ?? 'غير معروف';
            $this->line("   status={$status} ({$label}): {$cnt}");
        }

        $this->newLine();
        $this->info($dryRun ? 'انتهت المعاينة. شغّل بدون --dry-run لتطبيق التغييرات.' : 'انتهى الإصلاح بنجاح.');

        return self::SUCCESS;
    }
}
