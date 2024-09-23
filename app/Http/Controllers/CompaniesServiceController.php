<?php

namespace App\Http\Controllers;

use App\Models\CompaniesService;
use Illuminate\Http\Request;

class CompaniesServiceController extends Controller
{
    // جلب جميع خدمات الشركات
    public function index()
    {
        $services = CompaniesService::all();
        return response()->json($services);
    }

    // تخزين خدمة شركة جديدة
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
        $service = CompaniesService::create($request->all());

        return response()->json($service, 201);
    }

    // تحديث خدمة شركة موجودة
    public function update(Request $request, $id)
    {
        $service = CompaniesService::find($id);

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

    // حذف خدمة شركة
    public function destroy($id)
    {
        $service = CompaniesService::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $service->delete();

        return response()->json(['message' => 'Service deleted successfully']);
    }
}
