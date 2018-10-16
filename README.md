## Git Clone
```bash
git clone https://github.com/yumaeda/laravel-5.5.git laravel-5.5
```

## Launch Docker Containers
```bash
cd laravel-5.5
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
