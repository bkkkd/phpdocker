build:
	docker build --no-cache -t phpdocker:php8 .

run: build
	docker run --rm -p 18080:80 phpdocker:php8

shell: build
	docker run --rm -ti -p 18080:80 phpdocker:php8 bash
