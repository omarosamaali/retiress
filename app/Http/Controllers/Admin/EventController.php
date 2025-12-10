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
class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        $transactions = Transaction::with('user', 'event')->where('type', 'event')->latest()->paginate(10);

        return view('admin.events.index', compact('events', 'transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'price' => 'nullable|integer',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sub_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $eventData = [
            'title_ar' => $request->title_ar,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
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
        
        foreach($membersShip as $member){
            Mail::raw(' تم إضافة فعالية جديدة' . $request->title_ar, function ($message) use($member) {
                $message->to($member->email)->subject('تم اضافة فعالية جديدة');
            });
        }

        return redirect()->route('admin.event.index')->with('success', 'تمت إضافة الفعالية بنجاح!');
    }

    public function show(Event $event)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.events.show', compact('event', 'targetLanguages'));
    }

    public function edit(Event $event)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.events.edit', compact('event', 'targetLanguages'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'price' => 'nullable|integer',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sub_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
            'created_at' => 'required|date',
        ]);

        $eventData = [
            'title_ar' => $request->title_ar,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
            'created_at' => $request->created_at,
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

        return redirect()->route('admin.event.index')->with('success', 'تم تحديث الفعالية بنجاح!');
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

        return redirect()->route('admin.event.index')->with('success', 'تم حذف الفعالية بنجاح!');
    }
}
