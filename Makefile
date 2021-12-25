build: ##@Intsall Dependencies
	composer install
up: ##@Run locally
	docker-compose up -d --build
down: ##@Stop containers
	docker-compose down
