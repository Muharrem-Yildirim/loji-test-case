<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceiveController extends Controller
{
    public function store(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => sprintf(
                'Your message has been received by <b>%s</b> with following data: <b>%s</b> <br/><br/> X-Trace-ID: %s',
                'service-a',
                json_encode($request->all()),
                $request->header('X-Trace-ID')
            ),
        ]);
    }
}
