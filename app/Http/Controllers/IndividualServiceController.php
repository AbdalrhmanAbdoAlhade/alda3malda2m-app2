<?php

namespace App\Http\Controllers;

use App\Models\IndividualService;
use Illuminate\Http\Request;

class IndividualServiceController extends Controller
{
    // جلب جميع الخدمات الفردية
    public function index()
    {
        $services = IndividualService::all();
        return response()->json($services);
    }

    // تخزين خدمة فردية جديدة
    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string|max:255',
            'mail' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'service_type' => 'required|string|max:255',
            'service_details' => 'required|string',
        ]);

        // إنشاء سجل جديد
        $service = IndividualService::create($request->all());

        return response()->json($service, 201);
    }

    // تحديث خدمة فردية موجودة
    public function update(Request $request, $id)
    {
        $service = IndividualService::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $request->validate([
            'name' => 'nullable|string|max:255',
            'mail' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'service_type' => 'nullable|string|max:255',
            'service_details' => 'nullable|string',
        ]);

        $service->update($request->all());

        return response()->json($service);
    }

    // حذف خدمة فردية
    public function destroy($id)
    {
        $service = IndividualService::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $service->delete();

        return response()->json(['message' => 'Service deleted successfully']);
    }
}
