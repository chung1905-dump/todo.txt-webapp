APP_NAME=todo.txt
EXEC=docker-compose exec -w /var/www/html/ php

run: _generate_env _docker_up _composer_install

build: favicon_all

favicon_all: _generate_favicon _deploy_favicon _clean_favicon

_docker_up:
	docker-compose up -d

_composer_install:
	${EXEC} composer install

_generate_favicon:
	cd ./utils/favicon-generator/ && make all text=${APP_NAME}

_deploy_favicon:
	mv ./utils/favicon-generator/out/ ./src/pub/media/favicon/

_clean_favicon:
	cd ./utils/favicon-generator/ && make clean

_generate_env:
	echo "UID=$(shell id -u)" > .env
