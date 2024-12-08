#!/bin/bash

set -e

echo "Building and starting Docker containers..."

echo "Copying .env.example to .env and generating application key..."

cd front-end
cp .env.example .env
php artisan key:generate

cd ../service-a
cp .env.example .env
php artisan key:generate

cd ../service-b
cp .env.example .env
php artisan key:generate

docker-compose build
docker-compose up -d

echo "Waiting for containers to fully initialize..."
sleep 10  

echo "Running migrations in front-end container"
docker exec loji-test-case-front_end-1 php artisan migrate --force

echo "Front-end deployment completed successfully!"

echo "Running migrations in service-a container"
docker exec loji-test-case-service_a-1 php artisan migrate --force

echo "Service-A deployment completed successfully!"

echo "Running migrations in service-b container"
docker exec loji-test-case-service_b-1 php artisan migrate --force

echo "Service-B deployment completed successfully!"
