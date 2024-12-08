<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\PrometheusService;
use Illuminate\Support\Facades\Log;

class MetricsController extends Controller
{

    public function index(PrometheusService $prometheusService)
    {
        $metrics = $prometheusService->getMetrics();

        return response($metrics, 200)->header('Content-Type', 'text/plain');
    }
}
