<?php

namespace App\Http\Controllers;

use App\Models\GovernmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GovernmentServiceController extends Controller
{
    // جلب جميع الخدمات الحكومية
    public function index()
    {
        $services = GovernmentService::all();
        return response()->json($services);
    }

    // تخزين خدمة حكومية جديدة مع رفع اللوجو
    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // رفع الملف
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
        }

        // إنشاء سجل جديد
        $service = GovernmentService::create([
            'logo' => $path,
        ]);

        return response()->json($service, 201);
    }

    // تحديث خدمة حكومية موجودة
    public function update(Request $request, $id)
    {
        $service = GovernmentService::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            // حذف اللوجو القديم
            if ($service->logo) {
                Storage::disk('public')->delete($service->logo);
            }

            // رفع اللوجو الجديد
            $path = $request->file('logo')->store('logos', 'public');
            $service->logo = $path;
        }

        $service->save();

        return response()->json($service);
    }

    // حذف خدمة حكومية
    public function destroy($id)
    {
        $service = GovernmentService::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        // حذف اللوجو
        Storage::disk('public')->delete($service->logo);

        // حذف الخدمة
        $service->delete();

        return response()->json(['message' => 'Service deleted successfully']);
    }
}
