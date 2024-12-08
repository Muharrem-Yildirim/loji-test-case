<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('home');
    }

    public function store(Request $request)
    {
        $traceId = $request->header('X-Trace-Id') ?? uniqid('trace_');

        // @TODO: send request to service-a //
        dd(Http::serviceA()->get('/')->body());



        return redirect()->back();
    }
}
