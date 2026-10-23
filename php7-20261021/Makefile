build:
	docker build -t phpdocker:php7-20261021 .

run: build
	docker run --rm -p 18080:80 phpdocker:php7-20261021

shell: build
	docker run --rm -ti -p 18080:80 phpdocker:php7-20261021 bash
