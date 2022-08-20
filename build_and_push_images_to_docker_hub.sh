# Build and push laravel docker image
docker build -f docker/laravel/Dockerfile -t tkordicfpmoz/smart_sum_parking:latest .
docker push tkordicfpmoz/smart_sum_parking:latest

# Build and push client.js docker image
docker build -f docker/node/Dockerfile -t tkordicfpmoz/smart_sum_parking_clientjs:latest .
docker push tkordicfpmoz/smart_sum_parking_clientjs:latest
