# Loji Test Case

## Description

This project has 3 parts - front-end, service-a and service-b. **front-end** generates a Trace-ID and sends it to **service-a** then **service-a** publishes the Trace-ID to **service-b** via RabbitMQ.

Every service has log channels and all requests are logged in to their log channels. You can follow your requests with your Trace-ID.

To see prometheus metrics, go to http://localhost:8002/metrics

## Deployment

### Without deploy.sh:

1. Run: composer install in front-end, service-a and service-b folders.
2. Run: npm install and npm run build in front-end folder.
3. Copy .env.example to .env in front-end, service-a and service-b folders.
4. Run: php artisan key:generate && php artisan migrate in front-end, service-a and service-b folders.
5. Run: docker compose up -d in main folder.

### Via deploy.sh:

1. Run: composer install in front-end, service-a and service-b folders.
2. chmod +x deploy.sh
3. Run: ./deploy.sh

NOTE: Folder name must be `loji-test-case` otherwise **deploy.sh** will not work.

## What I used in this project

-   Laravel
-   Dapr
-   RabbitMQ
-   Inertia
-   Tailwind
-   Docker
