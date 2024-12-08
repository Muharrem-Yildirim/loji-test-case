<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConsumeController extends Controller
{
    public function store(Request $request)
    {
        Log::channel('consumed')->info(json_encode($request->all()));

        return response()->json([
            'success' => true,
            'message' => sprintf('Consumed successfully, Trace ID is %s', request()->input('data.data.trace_id')),
        ]);
    }
}
