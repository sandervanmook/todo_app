# Setup the project
* Start the docker containers: `./docker/docker-compose up -d`
* Run composer install : `docker exec docker_php_1 composer install`
* Create database : `docker exec docker_php_1 php bin/console doctrine:database:create`

# Run tests
* `docker exec docker_php_1 php vendor/bin/phpunit`

