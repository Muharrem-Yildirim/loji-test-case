#!/bin/bash

set -e

echo "Building and starting Docker containers..."

docker-compose down
docker-compose build --no-cache
docker-compose up -d

cd front-end

cp .env.example .env
php artisan key:generate

cd ../service-a

cp .env.example .env
php artisan key:generate


cd ../service-b

cp .env.example .env
php artisan key:generate


echo "Waiting for containers to fully initialize..."


echo "Running migrations in service-a container"
docker exec loji-test-case-service_a-1 php artisan migrate --force

echo "Service-A deployment completed successfully!"

echo "Running migrations in service-b container"
docker exec loji-test-case-service_b-1 php artisan migrate --force

echo "Service-B deployment completed successfully!"

echo "Running migrations in front-end container"

docker exec loji-test-case-front_end-1 php artisan migrate

echo "Front-end deployment completed successfully!"

