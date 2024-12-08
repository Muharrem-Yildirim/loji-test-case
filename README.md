# Loji Test Case

## Description

This project has 3 parts - front-end, service-a and service-b. **front-end** generates a Trace-ID and sends it to **service-a** then **service-a** publishes the Trace-ID to **service-b** via RabbitMQ.

Every service has log channels and all requests are logged in to their log channels. You can follow your requests with your Trace-ID.

To see prometheus metrics, go to http://localhost:8002/metrics

## Deployment

1. chmod +x deploy.sh
2. ./deploy.sh

## What I used in this project

-   Laravel
-   Dapr
-   RabbitMQ
-   Inertia
-   Tailwind
-   Docker
