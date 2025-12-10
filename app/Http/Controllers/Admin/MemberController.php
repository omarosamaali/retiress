<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Models\Council;
use App\Models\Committee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

class MemberController extends Controller
{

    public function index()
    {
        $members = Member::all();

        return view('admin.members.index', get_defined_vars());
    }

    public function create()
    {
        return view('admin.members.create', [
            'targetLanguages' => $this->targetLanguages,
            'committees' => Committee::all(),
            'councils' => Council::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'position_ar' => 'required|string|max:255',
            'committee_id' => 'nullable|integer|exists:committees,id',
            'council_id' => 'nullable|integer|exists:councils,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $memberData = [
            'name_ar' => $request->name_ar,
            'position_ar' => $request->position_ar,
            'committee_id' => $request->committee_id,
            'council_id' => $request->council_id,
            'status' => $request->status
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $titleColumn = 'name_' . $code;
            $descColumn = 'position_' . $code;
            try {
                if (in_array($titleColumn, (new Member())->getFillable())) {
                    $memberData[$titleColumn] = $tr->setTarget($code)->translate($request->name_ar);
                    $memberData[$descColumn] = $tr->setTarget($code)->translate($request->position_ar);
                } else {
                    Log::warning("Columns {$titleColumn} or {$descColumn} not found in Member model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $memberData[$titleColumn] = null;
                $memberData[$descColumn] = null;
                Log::error("Translation failed for {$code} (Member Store): " . $e->getMessage());
            }
        }

        if ($request->hasFile('image')) {
            $memberData['image'] = $request->file('image')->store('members/main', 'public');
        }

        Member::create($memberData);

        return redirect()->route('admin.member.index')->with('success', 'تمت إضافة محتوى صفحة "معلومات عنا" بنجاح!');
    }

    public function show(Member $member)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.members.show', compact('member', 'targetLanguages'));
    }

    public function edit($member)
    {
        $member = Member::findOrFail($member);
        $targetLanguages = $this->targetLanguages;
        $committees = Committee::all();
        $councils = Council::all();

        return view('admin.members.edit', compact('member', 'targetLanguages', 'committees', 'councils'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'position_ar' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'committee_id' => 'nullable|integer|exists:committees,id',
            'council_id' => 'nullable|integer|exists:councils,id',
            'status' => 'required|boolean',
        ]);

        $memberData = [
            'name_ar' => $request->name_ar,
            'position_ar' => $request->position_ar,
            'committee_id' => $request->committee_id,
            'council_id' => $request->council_id,
            'status' => $request->status
        ];

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $titleColumn = 'name_' . $code;
            $descColumn = 'position_' . $code;
            try {
                if (in_array($titleColumn, (new Member())->getFillable())) {
                    $memberData[$titleColumn] = $tr->setTarget($code)->translate($request->name_ar);
                    $memberData[$descColumn] = $tr->setTarget($code)->translate($request->position_ar);
                } else {
                    Log::warning("Columns {$titleColumn} or {$descColumn} not found in Member model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $memberData[$titleColumn] = null;
                $memberData[$descColumn] = null;
                Log::error("Translation failed for {$code} (Member Update): " . $e->getMessage());
            }
        }

        if ($request->hasFile('image')) {
            if ($member->image) {
                Storage::disk('public')->delete($member->image);
            }
            $memberData['image'] = $request->file('image')->store('members/main', 'public');
        } elseif ($request->boolean('remove_image')) {
            if ($member->image) {
                Storage::disk('public')->delete($member->image);
                $memberData['image'] = null;
            }
        }

        $member->update($memberData);

        return redirect()->route('admin.member.index')->with('success', 'تم تحديث محتوى صفحة "معلومات عنا" بنجاح!');
    }

    public function destroy(Member $member)
    {
        if ($member->image) {
            Storage::disk('public')->delete($member->image);
        }

        $member->delete();

        return redirect()->route('admin.member.index')->with('success', 'تم حذف محتوى صفحة "معلومات عنا" بنجاح!');
    }

}
