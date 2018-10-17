## Git Clone
```bash
git clone https://github.com/yumaeda/laravel-admin.git laravel-admin
```

## Launch Docker Containers
```bash
cd laravel-admin
docker run --rm -v $(pwd):/app composer/composer install
docker-compose up -d --build
```

## Configuration
```bash
cp .env.example .env
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan optimize
```

## Reference
https://medium.com/@shakyShane/laravel-docker-part-1-setup-for-development-e3daaefaf3c
