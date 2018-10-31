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
docker-compose exec app php artisan migrate --seed
```
## Migrate Commands ```bash
docker-compose exec app php artisan migrate:reset
docker-compose exec app php artisan migrate:refresh
docker-compose exec app php artisan db:seed
```

## Clear Cache Commands
```bash
docker-compose exec app php artisan view:clear
docker-compose exec app php artisan cache:clear
```

## Reset DB
```bash
docker-compose down
docker volume rm laravel-admin_dbdata
```

## Execute Phan
```bash
docker-compose exec app ./vendor/bin/phan
```

## Reference
https://thewebtier.com/laravel/understanding-roles-permissions-laravel/
