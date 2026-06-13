<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Service;
use App\Models\MemberApplication;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // ── Membership stats ──────────────────────────────────────────
        // status 3 = فعالة (approved & not expired)
        $activeMembersApplications = MemberApplication::where('status', '3')
            ->whereNull('expiration_date')
            ->orWhere(function ($q) {
                $q->where('status', '3')->where('expiration_date', '>', now());
            })
            ->latest()
            ->get();
        $activeMembersCount = $activeMembersApplications->count();

        // status 4 = منتهية manually, OR expired by date
        $expiredMembersCount = MemberApplication::where(function ($q) {
            $q->where('status', '4')
              ->orWhere(function ($q2) {
                  $q2->where('expiration_date', '<', now())
                     ->whereNotNull('expiration_date');
              });
        })->count();

        // pending breakdown
        $membersPendingPayment     = MemberApplication::where('status', '0')->count(); // بانتظار الدفع
        $membersPendingActivation  = MemberApplication::where('status', '1')->count(); // بانتظار التفعيل
        $membersPendingApproval    = MemberApplication::where('status', '2')->count(); // بانتظار الموافقة

        // ── Event stats ───────────────────────────────────────────────
        $activeEventsCount   = Event::where('status', 1)->count();
        $inActiveEventsCount = Event::where('status', 0)->count();
        $activeEvents        = Event::where('status', 1)->latest()->get();
        $inActiveEvents      = Event::where('status', 0)->latest()->get();

        // ── Dashboard tables: خدمات vs باقي الأنواع ──────────────────
        $serviceTypeEvents = Event::where('status', 1)
            ->whereIn('type', ['خدمات', 'مميزات'])
            ->latest()->limit(5)->get();

        $otherTypeEvents = Event::where('status', 1)
            ->whereNotIn('type', ['خدمات', 'مميزات'])
            ->latest()->limit(5)->get();

        // ── Service stats ─────────────────────────────────────────────
        $activeServicesCount   = Service::where('status', 1)->count();
        $inActiveServicesCount = Service::where('status', 0)->count();
        $activeServices        = Service::where('status', 1)->latest()->get();
        $inActiveServices      = Service::where('status', 0)->latest()->get();

        // ── Subscription (Transaction) stats — events only ────────────
        $subPending           = Transaction::where('type', 'event')->where('status', 'pending')->count();
        $subWaitingPayment    = Transaction::where('type', 'event')->where('status', 'waiting_for_payment')->count();
        $subWaitingActivation = Transaction::where('type', 'event')->where('status', 'waiting_for_activation')->count();
        $subActive            = Transaction::where('type', 'event')->where('status', 'active')->count();
        $subRejected          = Transaction::where('type', 'event')->where('status', 'rejected')->count();

        // ── Subscription (Transaction) stats — services only ──────────
        $svcSubPending           = Transaction::where('type', 'service')->where('status', 'pending')->count();
        $svcSubWaitingPayment    = Transaction::where('type', 'service')->where('status', 'waiting_for_payment')->count();
        $svcSubWaitingActivation = Transaction::where('type', 'service')->where('status', 'waiting_for_activation')->count();
        $svcSubActive            = Transaction::where('type', 'service')->where('status', 'active')->count();
        $svcSubRejected          = Transaction::where('type', 'service')->where('status', 'rejected')->count();

        // ── Dashboard alert counts ────────────────────────────────────
        $newMembershipRequests = $membersPendingApproval;

        // ── Recent requests table ─────────────────────────────────────
        $transactions = Transaction::whereNotIn('status', ['active', 'deactivated'])->paginate(5);
        $memberships  = MemberApplication::where('status', '!=', 4)->paginate(5);
        $services     = Service::latest()->where('status', 1)->limit(3)->get();

        // legacy aliases still used in blade
        $inActiveMembersApplications = collect();
        $inActiveMembersCount        = $expiredMembersCount;

        return view('admin.dashboard', compact(
            'memberships',
            'transactions',
            'services',
            'activeServices',
            'activeServicesCount',
            'inActiveServicesCount',
            'inActiveServices',
            'activeEvents',
            'activeEventsCount',
            'inActiveEvents',
            'inActiveEventsCount',
            'activeMembersApplications',
            'activeMembersCount',
            'inActiveMembersApplications',
            'inActiveMembersCount',
            'expiredMembersCount',
            'membersPendingPayment',
            'membersPendingActivation',
            'membersPendingApproval',
            'subPending',
            'subWaitingPayment',
            'subWaitingActivation',
            'subActive',
            'subRejected',
            'svcSubPending',
            'svcSubWaitingPayment',
            'svcSubWaitingActivation',
            'svcSubActive',
            'svcSubRejected',
            'newMembershipRequests',
            'serviceTypeEvents',
            'otherTypeEvents',
        ));
    }
}
