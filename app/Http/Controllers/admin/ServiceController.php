<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Transaction;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        $transactions = Transaction::with('user', 'service')->where('type', 'service')->latest()->paginate(10);
        return view('admin.services.index', compact('services', 'transactions'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string',
            'description_ar' => 'required|string',
            'target_audience_ar' => 'required|string',
            'required_documents_ar' => 'required|string',
            'service_charter_ar' => 'required|string',
            'disclaimer_ar' => 'required|string',
            'chanel' => 'required|string',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
            'is_payed' => 'nullable|boolean',
        ]);

        // Handle is_payed properly - checkbox sends '1' when checked, null when unchecked
        $isPayed = $request->has('is_payed') && $request->is_payed == '1';

        $serviceData = [
            'name_ar' => $request->name_ar,
            'description_ar' => $request->description_ar,
            'target_audience_ar' => $request->target_audience_ar,
            'required_documents_ar' => $request->required_documents_ar,
            'service_charter_ar' => $request->service_charter_ar,
            'disclaimer_ar' => $request->disclaimer_ar,
            'chanel' => $request->chanel,
            'status' => (bool)$request->status,
            'price' => $isPayed ? $request->price : null, // Only save price if service is paid
            'is_payed' => $isPayed, // This will be true or false
        ];

        if ($request->hasFile('image')) {
            $serviceData['image'] = $request->file('image')->store('services', 'public');
        }

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $nameColumn = 'name_' . $code;
            $descriptionColumn = 'description_' . $code;
            $targetAudienceColumn = 'target_audience_' . $code;
            $requiredDocumentsColumn = 'required_documents_' . $code;
            $serviceCharterColumn = 'service_charter_' . $code;
            $disclaimerColumn = 'disclaimer_' . $code;

            try {
                if (in_array($nameColumn, (new Service())->getFillable())) {
                    $serviceData[$nameColumn] = $tr->setTarget($code)->translate($request->input('name_ar'));
                    $serviceData[$descriptionColumn] = $tr->setTarget($code)->translate($request->input('description_ar'));
                    $serviceData[$targetAudienceColumn] = $tr->setTarget($code)->translate($request->input('target_audience_ar'));
                    $serviceData[$requiredDocumentsColumn] = $tr->setTarget($code)->translate($request->input('required_documents_ar'));
                    $serviceData[$serviceCharterColumn] = $tr->setTarget($code)->translate($request->input('service_charter_ar'));
                    $serviceData[$disclaimerColumn] = $tr->setTarget($code)->translate($request->input('disclaimer_ar'));
                } else {
                    Log::warning("Columns {$nameColumn} or {$descriptionColumn} not found in Service model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $serviceData[$nameColumn] = null;
                $serviceData[$descriptionColumn] = null;
                $serviceData[$targetAudienceColumn] = null;
                $serviceData[$requiredDocumentsColumn] = null;
                $serviceData[$serviceCharterColumn] = null;
                $serviceData[$disclaimerColumn] = null;
                Log::error("Translation failed for {$code} (Service Store): " . $e->getMessage());
            }
        }

        Service::create($serviceData);

        return redirect()->route('admin.services.index')->with('success', 'تمت إضافة الخدمة بنجاح!');
    }


    public function show(Service $service)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.services.show', compact('service', 'targetLanguages'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function edit(Service $service)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.services.edit', compact('service', 'targetLanguages'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name_ar' => 'required|string',
            'description_ar' => 'required|string',
            'target_audience_ar' => 'required|string',
            'required_documents_ar' => 'required|string',
            'service_charter_ar' => 'required|string',
            'disclaimer_ar' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'chanel' => 'required|string',
            'price' => 'nullable|numeric', // Changed to numeric for consistency
            'status' => 'required|boolean',
            'is_payed' => 'nullable|boolean', // Added validation for is_payed
        ]);

        // Handle is_payed properly - checkbox sends '1' when checked, null when unchecked
        $isPayed = $request->has('is_payed') && $request->is_payed == '1';

        $serviceData = [
            'name_ar' => $request->name_ar,
            'description_ar' => $request->description_ar,
            'target_audience_ar' => $request->target_audience_ar,
            'required_documents_ar' => $request->required_documents_ar,
            'service_charter_ar' => $request->service_charter_ar,
            'disclaimer_ar' => $request->disclaimer_ar,
            'chanel' => $request->chanel,
            'status' => (bool)$request->status,
            'price' => $isPayed ? $request->price : null, // Only save price if service is paid
            'is_payed' => $isPayed, // This will be true or false
        ];

        if ($request->hasFile('image')) {
            $serviceData['image'] = $request->file('image')->store('services', 'public');
        }

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $nameColumn = 'name_' . $code;
            $descriptionColumn = 'description_' . $code;
            $targetAudienceColumn = 'target_audience_' . $code;
            $requiredDocumentsColumn = 'required_documents_' . $code;
            $serviceCharterColumn = 'service_charter_' . $code;
            $disclaimerColumn = 'disclaimer_' . $code;

            try {
                if (in_array($nameColumn, (new Service())->getFillable())) {
                    $serviceData[$nameColumn] = $tr->setTarget($code)->translate($request->input('name_ar'));
                    $serviceData[$descriptionColumn] = $tr->setTarget($code)->translate($request->input('description_ar'));
                    $serviceData[$targetAudienceColumn] = $tr->setTarget($code)->translate($request->input('target_audience_ar'));
                    $serviceData[$requiredDocumentsColumn] = $tr->setTarget($code)->translate($request->input('required_documents_ar'));
                    $serviceData[$serviceCharterColumn] = $tr->setTarget($code)->translate($request->input('service_charter_ar'));
                    $serviceData[$disclaimerColumn] = $tr->setTarget($code)->translate($request->input('disclaimer_ar'));
                } else {
                    Log::warning("Columns {$nameColumn} or {$descriptionColumn} not found in Service model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $serviceData[$nameColumn] = null;
                $serviceData[$descriptionColumn] = null;
                $serviceData[$targetAudienceColumn] = null;
                $serviceData[$requiredDocumentsColumn] = null;
                $serviceData[$serviceCharterColumn] = null;
                $serviceData[$disclaimerColumn] = null;
                Log::error("Translation failed for {$code} (Service Update): " . $e->getMessage());
            }
        }

        $service->update($serviceData);

        return redirect()->route('admin.services.index')->with('success', 'تم تحديث الخدمة بنجاح!');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'تم حذف الخبر بنجاح!');
    }
}
