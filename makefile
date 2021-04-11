config:
	docker-compose run php php artisan config:cache

sh:
	docker-compose exec php sh

setup:
	docker-compose run php php artisan passport:client --personal