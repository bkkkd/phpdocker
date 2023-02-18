build:
	docker build -t phpdocker:php7 .

run: build
	docker run --rm -p 18080:80 phpdocker:php7

shell: build
	docker run --rm -ti -p 18080:80 phpdocker:php7 bash
