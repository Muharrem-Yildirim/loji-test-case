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

        $publishResponse = Http::dapr()->post('/publish/rabbitmq-pubsub/default', [
            'operation' => 'create',
            'data' => $request->validated(),
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
