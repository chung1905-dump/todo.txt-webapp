APP_NAME=todo.txt

run: generate_env

build: favicon_all

favicon_all: generate_favicon deploy_favicon clean_favicon

generate_favicon:
	cd ./utils/favicon-generator/ && make all text=${APP_NAME}

deploy_favicon:
	mv ./utils/favicon-generator/out/ ./src/pub/media/favicon/

clean_favicon:
	cd ./utils/favicon-generator/ && make clean

generate_env:
	echo "UID=$(shell id -u)" > .env
