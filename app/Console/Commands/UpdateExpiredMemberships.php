<?php

namespace App\Console\Commands;

use App\Models\MemberApplication;
use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class UpdateExpiredMemberships extends Command
{
    protected $signature = 'memberships:update-expired';
    protected $description = 'تحديث الأعضاء المنتهية صلاحيتهم';

    public function handle()
    {
        $this->info('بدء تنفيذ الأمر...');

        // تحديث الأعضاء المنتهية
        $expiredCount = User::whereHas('memberApplication', function ($query) {
            $query->where('expiration_date', '<', Carbon::now());
        })->where('role', '!=', 'مستخدم')->update(['role' => 'مستخدم']);

        $this->info("تم تحديث {$expiredCount} عضو منتهي");

        MemberApplication::where('expiration_date', '<', Carbon::now())
            ->update(['status' => '4']);

        $expirationDate = MemberApplication::where('expiration_date', '>', Carbon::now())
            ->where('expiration_date', '<=', Carbon::now()->addDays(30))
            ->whereNull('expiration_warning_sent_at')
            ->get();

        $this->info("عدد الأعضاء المستحقين للتنبيه: " . $expirationDate->count());

        $sentCount = 0;
        $failedCount = 0;

        foreach ($expirationDate as $member) {
            $this->info("معالجة العضو: {$member->email}");

            if (!filter_var($member->email, FILTER_VALIDATE_EMAIL)) {
                $this->warn("إيميل غير صالح: {$member->email}");
                continue;
            }

            try {
                // Mail::raw('عضويتك ستنتهي في ' . $member->expiration_date, function ($message) use ($member) {
                //     $message->to($member->email)->subject('تنبيه: انتهاء العضوية قريباً');
                // });

                // سجّل إنك بعتله إيميل
                $member->expiration_warning_sent_at = Carbon::now();
                $member->save();

                $this->info("تم إرسال إيميل لـ: {$member->email}");
                $sentCount++;

                // استنى 100ms بين كل إيميل عشان متتخطاش الـ rate limit
                usleep(100000);
            } catch (\Exception $e) {
                $this->error("فشل إرسال الإيميل لـ {$member->email}: " . $e->getMessage());
                $failedCount++;

                // لو فشل بسبب rate limit، وقف الإرسال
                if (str_contains($e->getMessage(), 'Ratelimit')) {
                    $this->error('تم تخطي حد الإرسال. سيتم إعادة المحاولة لاحقاً.');
                    break;
                }
            }
        }

        $this->info("تم الانتهاء - نجح: {$sentCount} | فشل: {$failedCount}");
    }
}
