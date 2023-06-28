build:
	docker build -t phpdocker:nodejs .

run: build
	docker run --rm -p 18080:80 phpdocker:nodejs

shell: build
	docker run --rm -ti -p 18080:80 phpdocker:nodejs bash
