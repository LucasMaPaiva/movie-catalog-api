include .env

define-environment:
	@echo "Using ${DOCKER_COMPOSE_FILE} file"

SERVICE_NAMES := $(shell grep -v '^#' .env | sed '/^[[:space:]]*$$/d' | grep '^DOCKER_SERVICE_' | cut -d '=' -f 2- | tr '\n' ' ')
build: ## Executa o build de todos os containers listados no docker-compose
	make define-environment
	@docker compose -f ${DOCKER_COMPOSE_FILE} build $(SERVICE_NAMES) --no-cache


up: ## Executa o start de todos os containers listados no docker-compose.yml e definidos no .env
	@docker compose -f ${DOCKER_COMPOSE_FILE} up -d $(SERVICE_NAMES)

down: ## Encerra todos os containers listados no docker-compose
	make define-environment
	@docker compose -f ${DOCKER_COMPOSE_FILE} down

key-generate: ## Executa o composer install
	make define-environment
	docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} php artisan key:generate

refresh:
	make composer-install
	make clear

ref_prod:
	make refresh
	make cache

views:
	make define-environment
	docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} php artisan db:seed RefreshViewsSeeder

lib ?=
composer-require: ## Instala uma nova lib utilizando o composer
ifdef lib
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} composer require $(lib)
else
	echo "Informe o nome da lib a ser instalada"
endif

composer-install: ## Executa o composer install
	make define-environment
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} composer install --no-interaction

composer-update: ## Executa o composer update
	make define-environment
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} composer update --no-interaction

composer-dump: ## Executa o composer dump
	make define-environment
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} composer dump --no-interaction

node-install: ## Executa bower e yarn install
	make define-environment
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} npm install --non-interactive

delete-node_modules: ## Remove a pasta node_modules
	make define-environment
	docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} rm -Rf node_modules

delete-vendor: ## Remove a pasta node_modules
	make define-environment
	docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} rm -Rf vendor

env ?=
node-run: ## Roda o comando npm run
ifdef env
	echo "Rodando yarn run no modo $(env)"
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} npm run $(env)
else
	echo "Rodando yarn run no modo prod"
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} npm run prod
endif

migrate: ## Executa o comando php artisan migrate --force
	make define-environment
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} php artisan migrate --force

migrate-fresh: ## Executa o comando php artisan migrate --force
	make define-environment
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} php artisan migrate:fresh

clear: ## Executa o comando php artisan migrate --force
	make define-environment
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} php artisan optimize:clear

cache: ## Realiza a criação de cache
	make define-environment
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} php artisan config:cache
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} php artisan route:cache

db-seed: ## Executa o comando php artisan db:seed
	make define-environment
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} php artisan db:seed

## Exemplo: make assign-password password=12345678
assign-password:
	make define-environment
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} php artisan password:assign --password=$(password)

in: ## Lista todos os containers levantados para o usuário escolher um e entrar
	@bash .docker/scripts/in.sh

group ?=
filter ?=

certbot-run: ## Solicita a primeira instalação do certificado digital utilizando certbot
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec nginx certbot run --nginx --agree-tos --no-eff-email -m ${CERTBOT_EMAIL_ADDRESS} -d ${CERTBOT_DOMAIN}

certbot-renew: ## Solicita a renovação do certificado digital utilizando certbot
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec nginx certbot renew

passport-install: ## Faz install do passport
	make define-environment
	docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} php artisan passport:install

openapi: ## Faz o build do arquivo do swagger
	make define-environment
	echo "Atualizando a documentação do swagger.."
	docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} php artisan openapi:build

restart: ## Restarta todos os containers em execução
	make define-environment
	make down
	make up
	make refresh

test:
	make define-environment
	@docker compose -f ${DOCKER_COMPOSE_FILE} exec ${DOCKER_SERVICE_PHP_FPM} php artisan test

install: ## Instala a aplicação executando todos os passos necessários
	echo "MOVIE CATALOG install"
	make build
	make up
	make delete-node_modules
	make delete-vendor
	make composer-install
	make key-generate
	echo "Install finished!"

## Configuração de deploy
deploy:
	echo "MOVIE CATALOG DEPLOY!"
	make define-environment
	make clear
	make down
	make up
	make refresh
	make migrate
	make cache
	echo "DEPLOY FINALIZADO!"
