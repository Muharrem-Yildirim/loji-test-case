<?php

namespace App\Http\Controllers;

use App\Enums\MetricNames;
use App\Enums\MetricNamespaces;
use App\Services\PrometheusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConsumeController extends Controller
{
    public function store(Request $request, PrometheusService $prometheusService)
    {
        Log::channel('consumed')->info(json_encode($request->all()));

        $prometheusService->incrementCounter(MetricNamespaces::REQUEST->value, MetricNames::MESSAGES_PROCESSED_TOTAL->value);

        return response()->json([
            'success' => true,
            'message' => sprintf('Consumed successfully, Trace ID is %s', request()->input('data.trace_id')),
        ]);
    }
}
