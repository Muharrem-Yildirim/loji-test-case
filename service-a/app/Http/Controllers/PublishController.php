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

        $publishResponse = Http::dapr()->withHeaders(
            [
                'X-Trace-ID' => $request->header('X-Trace-ID')
            ]
        )->post('/publish/rabbitmq-pubsub/default', [
            'operation' => 'create',
            ...$request->validated(),
            'metadata' => [
                'contentType' => 'application/json',
                'X-Trace-ID' => $request->header('X-Trace-ID'),
            ],
        ]);

        if ($publishResponse->failed()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $publishResponse->body(),
                ],
                500
            );
        }

        Log::channel('service-b.publish')->info(($publishResponse->body()));

        return response()->json([
            'success' => true,
            'message' => sprintf(
                'Your message has been published by <b>%s</b> with following data: <b>%s</b> <br/><br/> X-Trace-ID: %s',
                'service-a',
                json_encode($request->validated()),
                $request->header('X-Trace-ID'),
            ),
        ]);
    }
}
