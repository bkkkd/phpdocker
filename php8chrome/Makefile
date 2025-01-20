build:
	docker build -t phpdocker:php8chrome .

run: build
	docker run --rm -p 18080:80 phpdocker:php8chrome

shell: build
	docker run --rm -ti -p 18080:80 phpdocker:php8lua bash
