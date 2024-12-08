<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublishRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PublishController extends Controller
{
    public function store(PublishRequest $request)
    {
        Log::channel('frontend.receive')->info(json_encode($request->all()));

        //@TODO: send to service-b via RabbitMQ publish

        $response = Http::withHeaders([
            'dapr-app-id' => 'service-a',  // Dapr app id for Service A
        ])->post('http://localhost:3500/api/consume', [
            'data' => $request->validated(),

        ]);

        Log::channel('service-b.publish')->info(($response->body()));

        return response()->json([
            'success' => true,
            'message' => sprintf(
                'Your message has been published by <b>%s</b> with following data: <b>%s</b> <br/><br/> X-Trace-ID: %s',
                'service-a',
                json_encode($request->validated()),
                $request->header('X-Trace-ID')
            ),
        ]);
    }
}
