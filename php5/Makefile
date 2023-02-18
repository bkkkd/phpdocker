build:
	docker build -t phpdocker:php5 .

run: build
	docker run --rm -p 18080:80 phpdocker:php5

shell: build
	docker run --rm -ti -p 18080:80 phpdocker:php5 bash
