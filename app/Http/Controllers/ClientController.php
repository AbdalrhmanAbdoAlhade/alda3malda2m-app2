<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    // جلب جميع العملاء
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients);
    }

    // تخزين عميل جديد مع رفع اللوجو
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
        $client = Client::create([
            'logo' => $path,
        ]);

        return response()->json($client, 201);
    }

    // تحديث بيانات عميل
    public function update(Request $request, $id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            // حذف اللوجو القديم
            if ($client->logo) {
                Storage::disk('public')->delete($client->logo);
            }

            // رفع اللوجو الجديد
            $path = $request->file('logo')->store('logos', 'public');
            $client->logo = $path;
        }

        $client->save();

        return response()->json($client);
    }

    // حذف عميل
    public function destroy($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        // حذف اللوجو
        Storage::disk('public')->delete($client->logo);

        // حذف العميل
        $client->delete();

        return response()->json(['message' => 'Client deleted successfully']);
    }
}
