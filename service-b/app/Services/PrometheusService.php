<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class PrometheusService
{
    protected $metrics = [];

    public function __construct()
    {
        $this->loadMetrics();
    }

    public function incrementCounter(string $namespace, string $metricName)
    {
        $this->metrics[$namespace][$metricName]['value']++;

        $this->saveMetrics();
    }

    public function getMetrics()
    {
        $metricsText = '';

        foreach ($this->metrics as $namespace => $metrics) {
            foreach ($metrics as $metricName => $metric) {
                $metricsText .= "# HELP {$namespace}_{$metricName} {$metric['description']}\n";
                $metricsText .= "# TYPE {$namespace}_{$metricName} {$metric['type']}\n";
                $metricsText .= "{$namespace}_{$metricName} {$metric['value']}\n";
            }
        }

        return $metricsText;
    }

    public function saveMetrics()
    {
        Cache::forever('metrics', $this->metrics);
    }

    private function getDefaultMetrics()
    {
        return [
            'request' => [
                'messages_processed_total' => [
                    'description' => 'Total number of messages processed by service_b',
                    'type' => 'counter',
                    'value' => 0,
                ],
            ],
        ];
    }

    public function loadMetrics()
    {
        $this->metrics =  Cache::get('metrics', $this->getDefaultMetrics());
    }
}
