<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        // نفترض أن هناك صف واحد فقط يحتوي على الإحصائيات
        $statistics = Statistic::first();

        if (!$statistics) {
            return response()->json(['message' => 'Statistics not found'], 404);
        }

        return response()->json([
            'clients' => $statistics->clients,
            'Annual_contracts' => $statistics->Annual_contracts,
            'Years_of_experience' => $statistics->Years_of_experience,
            'Long_term_contracts' => $statistics->Long_term_contracts,
        ]);
    }

    public function store(Request $request)
    {
        // التحقق من المدخلات
        $validated = $request->validate([
            'clients' => 'required|integer',
            'Annual_contracts' => 'required|integer',
            'Years_of_experience' => 'required|integer',
            'Long_term_contracts' => 'required|integer',
        ]);

        // تحديث أو إنشاء إحصائيات
        $statistics = Statistic::first() ?? new Statistic();
        $statistics->clients = $validated['clients'];
        $statistics->Annual_contracts = $validated['Annual_contracts'];
        $statistics->Years_of_experience = $validated['Years_of_experience'];
        $statistics->Long_term_contracts = $validated['Long_term_contracts'];
        $statistics->save();

        return response()->json(['message' => 'Statistics updated successfully']);
    }
}
