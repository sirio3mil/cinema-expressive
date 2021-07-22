## Getting Started

```shell
docker-compose up -d
docker exec -it graphql bash

docker cp graphql:/usr/share/nginx/html/api/vendor/ .
docker cp graphql:/usr/share/nginx/html/api/composer.lock .
docker cp graphql:/usr/share/nginx/html/api/composer.json .

composer generate-proxies
```
