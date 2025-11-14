build:
	docker build -t phpdocker:php8luaffmpeg .

run: build
	docker run --rm -p 18080:80 phpdocker:php8luaffmpeg

shell: build
	docker run --rm -ti -p 18080:80 phpdocker:php8luaffmpeg bash
