config:
	docker-compose run php php artisan config:cache

setup:
	docker-compose run php php artisan passport:client --personal