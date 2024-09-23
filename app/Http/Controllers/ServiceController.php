<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    // جلب جميع الخدمات
    public function index()
    {
        $services = Service::all();
        return response()->json($services);
    }

    // تخزين خدمة جديدة
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'details' => 'required|string',
        'date' => 'required|date',
        'viewers' => 'nullable|integer',
        'country' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'street' => 'required|string|max:255',
        'images' => 'required|array',
    ]);

    $images = [];
    if ($request->has('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('services/images', 'public');
            $images[] = $path;
        }
    }

    $serviceData = $request->all();
    $serviceData['images'] = $images; // إضافة المسارات الجديدة للصور

    $service = Service::create($serviceData);

    return response()->json($service, 201);
}


    // تحديث خدمة موجودة
    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $request->validate([
            'name' => 'nullable|string|max:255',
            'details' => 'nullable|string',
            'date' => 'nullable|date',
            'viewers' => 'nullable|integer',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'images' => 'nullable|array',
        ]);

        $images = $service->images; // الاحتفاظ بالصور القديمة

        if ($request->has('images')) {
            // يمكنك حذف الصور القديمة إذا لزم الأمر
            foreach ($images as $oldImage) {
                \Storage::disk('public')->delete($oldImage);
            }

            $images = []; // إعادة تعيين الصور
            foreach ($request->file('images') as $image) {
                $path = $image->store('services/images', 'public');
                $images[] = $path;
            }
        }

        $serviceData = $request->all();
        $serviceData['images'] = $images; // تحديث المسارات الجديدة للصور

        $service->update($serviceData);

        return response()->json($service);
    }

    // حذف خدمة
    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $service->delete();

        return response()->json(['message' => 'Service deleted successfully']);
    }
}
