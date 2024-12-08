<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceiveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReceiveController extends Controller
{
    public function store(ReceiveRequest $request)
    {
        Log::channel('frontend.receive')->info(json_encode($request->all()));

        //@TODO: send to service-b via RabbitMQ publish

        return response()->json([
            'success' => true,
            'message' => sprintf(
                'Your message has been received by <b>%s</b> with following data: <b>%s</b> <br/><br/> X-Trace-ID: %s',
                'service-a',
                json_encode($request->validated()),
                $request->header('X-Trace-ID')
            ),
        ]);
    }
}
