<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ParkirController extends Controller
{
    public function index()
    {
        $logs = DB::table('parkir_logs')
                    ->orderBy('id', 'desc')
                    ->limit(20)
                    ->get();

        return view('parkir.index', compact('logs'));
    }
}
