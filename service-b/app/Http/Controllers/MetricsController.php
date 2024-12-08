<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\PrometheusService;

class MetricsController extends Controller
{

    public function index(PrometheusService $prometheusService)
    {
        $metrics = $prometheusService->getMetrics();

        return response($metrics, 200)->header('Content-Type', 'text/plain');
    }
}
