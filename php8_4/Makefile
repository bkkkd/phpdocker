build:
	docker build -t phpdocker:php8_4 .

run: 
	docker run --rm -p 18080:80 phpdocker:php8_4

shell: 
	docker run --rm -ti -p 18080:80 phpdocker:php8_4 bash
test:
	docker run --rm -it registry.cn-shenzhen.aliyuncs.com/alpicool/docker-base:noble bash