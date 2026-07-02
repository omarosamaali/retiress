<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;
use App\Models\MemberApplication;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title_ar', 'like', "%{$search}%")
                  ->orWhere('title_en', 'like', "%{$search}%");
            });
        }

        $events = $query->paginate(10)->withQueryString();
        $transactions = Transaction::with('user', 'event')->where('type', 'event')->latest()->paginate(10);

        return view('admin.events.index', compact('events', 'transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => ['required', Rule::in(Event::TYPES)],
            'audience' => ['required', Rule::in(Event::AUDIENCES)],
            'title_ar' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'price' => 'nullable|integer',
            'main_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:5120',
            'sub_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:5120',
            'status' => 'required|boolean',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
            'subscription_deadline' => 'nullable|date',
        ]);

        $eventData = [
            'type' => $request->type,
            'audience' => $request->audience,
            'title_ar' => $request->title_ar,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
            'price' => $request->is_payed === 'on' ? $request->price : null,
            'starts_at' => $request->starts_at,
            'ends_at' => $request->ends_at,
            'subscription_deadline' => $request->subscription_deadline ?: null,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $titleColumn = 'title_' . $code;
            $descColumn = 'description_' . $code;
            try {
                if (in_array($titleColumn, (new Event())->getFillable())) {
                    $eventData[$titleColumn] = $tr->setTarget($code)->translate($request->input('title_ar'));
                    $eventData[$descColumn] = $tr->setTarget($code)->translate($request->input('description_ar'));
                } else {
                    Log::warning("Columns {$titleColumn} or {$descColumn} not found in Event model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $eventData[$titleColumn] = null;
                $eventData[$descColumn] = null;
                Log::error("Translation failed for {$code} (Event Store): " . $e->getMessage());
            }
        }

        if ($request->hasFile('main_image')) {
            $eventData['main_image'] = $request->file('main_image')->store('news/main', 'public');
        }

        if ($request->hasFile('sub_image')) {
            $eventData['sub_image'] = $request->file('sub_image')->store('news/sub', 'public');
        }

        Event::create($eventData);
        $membersShip = MemberApplication::where('expiration_date', '>', now())->get();
        
        // foreach($membersShip as $member){
        //     Mail::raw(' تم إضافة فعالية جديدة' . $request->title_ar, function ($message) use($member) {
        //         $message->to($member->email)->subject('تم اضافة فعالية جديدة');
        //     });
        // }

        return redirect()->route('admin.event.index')->with('success', 'تمت إضافة الإعلان بنجاح!');
    }

    public function show(Event $event, Request $request)
    {
        $targetLanguages = $this->targetLanguages;
        $subscriberData = $this->subscriberDataForEvent($event, $request->input('subscription_status'));

        return view('admin.events.show', compact('event', 'targetLanguages') + $subscriberData);
    }

    public function edit(Event $event, Request $request)
    {
        $targetLanguages = $this->targetLanguages;
        $subscriberData = $this->subscriberDataForEvent($event, $request->input('subscription_status'));

        return view('admin.events.edit', compact('event', 'targetLanguages') + $subscriberData);
    }

    public function printView(Event $event)
    {
        $approvedTransactions = Transaction::with('user')
            ->where('event_id', $event->id)
            ->where('status', 'active')
            ->orderByDesc('subscribed_at')
            ->get();

        return view('admin.events.print', compact('event', 'approvedTransactions'));
    }

    public function exportApprovedSubscribers(Event $event): StreamedResponse
    {
        $transactions = $this->approvedSubscribersForEvent($event);
        $safeTitle = preg_replace('/[^\p{L}\p{N}\-_]+/u', '-', $event->title_ar) ?: 'event';
        $filename = 'subscribers-' . $event->id . '-' . trim($safeTitle, '-') . '.csv';

        return response()->streamDownload(function () use ($transactions, $event) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                '#',
                'عنوان الإعلان',
                'تاريخ الاشتراك',
                'اسم المشترك',
                'البريد',
                'نوع المعاملة',
                'حالة الاشتراك',
            ]);

            foreach ($transactions as $index => $transaction) {
                fputcsv($handle, [
                    $index + 1,
                    $event->title_ar,
                    $transaction->subscribed_at
                        ? $transaction->subscribed_at->format('d/m/Y H:i')
                        : '—',
                    $transaction->user?->name ?? '—',
                    $transaction->user?->email ?? '—',
                    $transaction->type_label,
                    $transaction->status_label,
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    protected function approvedSubscribersForEvent(Event $event)
    {
        return Transaction::with('user')
            ->where('event_id', $event->id)
            ->whereIn('status', Transaction::APPROVED_SUBSCRIPTION_STATUSES)
            ->orderByDesc('subscribed_at')
            ->get();
    }

    protected function subscriberDataForEvent(Event $event, ?string $statusFilter = null): array
    {
        $query = Transaction::with('user')
            ->where('event_id', $event->id)
            ->orderByDesc('subscribed_at');

        if ($statusFilter && $statusFilter !== 'all' && in_array($statusFilter, Transaction::SUBSCRIPTION_STATUSES, true)) {
            $query->where('status', $statusFilter);
        }

        $eventTransactions = $query->get();

        $allEventTransactions = Transaction::where('event_id', $event->id)->get();
        $subscriptionStatusCounts = ['all' => $allEventTransactions->count()];
        foreach (Transaction::SUBSCRIPTION_STATUSES as $status) {
            $subscriptionStatusCounts[$status] = $allEventTransactions->where('status', $status)->count();
        }

        $subscriptionTypeCounts = $allEventTransactions
            ->groupBy(fn ($t) => $t->type ?: 'غير محدد')
            ->map->count()
            ->all();

        return [
            'eventTransactions' => $eventTransactions,
            'subscriptionStatusCounts' => $subscriptionStatusCounts,
            'subscriptionTypeCounts' => $subscriptionTypeCounts,
            'subscriptionStatusFilter' => $statusFilter ?: 'all',
        ];
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'type' => ['required', Rule::in(Event::TYPES)],
            'audience' => ['required', Rule::in(Event::AUDIENCES)],
            'title_ar' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'price' => 'nullable|integer',
            'main_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:5120',
            'sub_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:5120',
            'status' => 'required|boolean',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
            'subscription_deadline' => 'nullable|date',
        ]);

        $eventData = [
            'type' => $request->type,
            'audience' => $request->audience,
            'title_ar' => $request->title_ar,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
            'starts_at' => $request->starts_at,
            'ends_at' => $request->ends_at,
            'subscription_deadline' => $request->subscription_deadline ?: null,
            'price' => $request->is_payed === 'on' ? $request->price : null,
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $titleColumn = 'title_' . $code;
            $descColumn = 'description_' . $code;
            try {
                if (in_array($titleColumn, (new Event())->getFillable())) {
                    $eventData[$titleColumn] = $tr->setTarget($code)->translate($request->input('title_ar'));
                    $eventData[$descColumn] = $tr->setTarget($code)->translate($request->input('description_ar'));
                } else {
                    Log::warning("Columns {$titleColumn} or {$descColumn} not found in Event model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $eventData[$titleColumn] = null;
                $eventData[$descColumn] = null;
                Log::error("Translation failed for {$code} (Event Update): " . $e->getMessage());
            }
        }

        if ($request->hasFile('main_image')) {
            if ($event->main_image) {
                Storage::disk('public')->delete($event->main_image);
            }
            $eventData['main_image'] = $request->file('main_image')->store('news/main', 'public');
        } elseif ($request->boolean('remove_main_image')) {
            if ($event->main_image) {
                Storage::disk('public')->delete($event->main_image);
                $eventData['main_image'] = null;
            }
        }

        if ($request->hasFile('sub_image')) {
            if ($event->sub_image) {
                Storage::disk('public')->delete($event->sub_image);
            }
            $eventData['sub_image'] = $request->file('sub_image')->store('news/sub', 'public');
        } elseif ($request->boolean('remove_sub_image')) {
            if ($event->sub_image) {
                Storage::disk('public')->delete($event->sub_image);
                $eventData['sub_image'] = null;
            }
        }

        $event->update($eventData);

        return redirect()->route('admin.event.index')->with('success', 'تم تحديث الإعلان بنجاح!');
    }

    public function destroy(Event $event)
    {
        if ($event->main_image) {
            Storage::disk('public')->delete($event->main_image);
        }
        if ($event->sub_image) {
            Storage::disk('public')->delete($event->sub_image);
        }

        $event->delete();

        return redirect()->route('admin.event.index')->with('success', 'تم حذف الإعلان بنجاح!');
    }
}
