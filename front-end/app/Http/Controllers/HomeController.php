<?php

namespace App\Http\Controllers;

use App\Http\Requests\PushServiceARequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('home');
    }


    public function store(PushServiceARequest $request)
    {
        $traceId = $request->header('X-Trace-Id') ?? str()->uuid()->toString();

        $response = Http::serviceA()
            ->withHeaders(['X-Trace-Id' => $traceId])
            ->acceptJson()
            ->post('/api/publish', [
                'message' => $request->get('message', 'default message'),
            ]);

        Context::add('trace_id', $traceId);
        Context::add('service_status_code', $response->status());

        if ($response->failed()) {
            Log::channel('service-a.send')->error(
                minify($response->body()),
            );

            if ($response->status() === SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY) {
                return back()->withErrors([
                    'error' => $response->json()['message'],
                ]);
            }

            return back()->withErrors([
                'error' => 'Something went wrong.',
            ]);
        }

        Log::channel('service-a.send')->info(
            minify($response->body()),
        );

        $serviceMessage = array_key_exists('message', $response->json() ?? [])
            ? $response->json()['message'] : null;

        return Inertia::render('home', [
            'traceId' => $traceId,
            'serviceResponse' => $serviceMessage,
        ]);
    }
}
