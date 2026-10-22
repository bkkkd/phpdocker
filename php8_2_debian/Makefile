build:
	docker build -t phpdocker:php8_2 .

run: build
	docker run --rm -p 18080:80 phpdocker:php8_2

shell: build
	docker run --rm -ti -p 18080:80 phpdocker:php8_2 bash

test: build
	docker run --rm phpdocker:php8_2 php -m
