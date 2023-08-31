current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

.PHONY: default
default: start

.PHONY: build
build: deps

.PHONY: deps
deps: composer-install

# 🎻 Symfony
# Usage `make sf CMD="debug:router"`
.PHONY: sf
sf-clear-cache: CMD=c:c --no-debug

sf sf-clear-cache:
	@docker exec -it tech-test-app php bin/console $(CMD)

# 🐘 Composer
.PHONY: composer-install
composer-install: CMD=install

.PHONY: composer-update
composer-update: CMD=update

.PHONY: composer-require
composer-require: CMD=require
composer-require: INTERACTIVE=-ti --interactive

.PHONY: composer-require-module
composer-require-module: CMD=require $(module)
composer-require-module: INTERACTIVE=-ti --interactive

.PHONY: composer
composer composer-install composer-update composer-require composer-require-module:
		docker exec tech-test-app composer $(CMD)

# 🐳 Docker Compose
.PHONY: init
init: CMD=up --build -d

.PHONY: start
start: CMD=up -d

.PHONY: stop
stop: CMD=stop

.PHONY: destroy
destroy: CMD=down

.PHONY: doco
doco init:
	@docker-compose $(CMD)

.PHONY: docos
docos start stop destroy:
	@docker-compose $(CMD)

.PHONY: status
status:
	docker ps

.PHONY: rebuild
rebuild:
	docker-compose build --pull --force-rm --no-cache
	make start
	make deps
