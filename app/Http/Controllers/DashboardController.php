<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Service;
use App\Models\MemberApplication;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {

        $transactions = Transaction::whereNotIn('status', ['active', 'deactivated'])->get();
        $memberships = MemberApplication::where('status', '!=', 4)->get();

        $events = Event::latest()->where('status', 1)->limit(3)->get();
        $services = Service::latest()->where('status', 1)->limit(3)->get();
        $activeMembersApplications = MemberApplication::where('status', '1')->get();
        $activeMembersCount = $activeMembersApplications->count();
        $inActiveMembersApplications = MemberApplication::where('status', '4')->get();
        $inActiveMembersCount = $inActiveMembersApplications->count();
        $activeEvents = Event::latest()->where('status', 1)->get();
        $activeEventsCount = $activeEvents->count();
        $inActiveEvents = Event::latest()->where('status', 0)->get();
        $inActiveEventsCount = $inActiveEvents->count();
        $activeServices = Service::latest()->where('status', 1)->get();
        $activeServicesCount = $activeServices->count();

        return view('admin.dashboard', compact(
            'memberships',
            'transactions',
            'services',
            'activeServices',
            'activeServicesCount',
            'events',
            'activeMembersApplications',
            'activeMembersCount',
            'inActiveMembersApplications',
            'inActiveMembersCount',
            'activeEvents',
            'activeEventsCount',
            'inActiveEvents',
            'inActiveEventsCount'
        ));
    }
}
