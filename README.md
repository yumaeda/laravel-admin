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

## Execute PHPMD
```bash
docker-compose exec app ./vendor/bin/phpmd ./app text ./phpmd.xml
```

## PHP-CS-Fixer
ドライランで修正箇所の確認をする
```bash
docker-compose exec app ./vendor/bin/php-cs-fixer fix --dry-run --diff --diff-format udiff ./app
```

コードの修正を行う
```bash
docker-compose exec app ./vendor/bin/php-cs-fixer fix
```

ルールの詳細を確認する
```bash
docker-compose exec app ./vendor/bin/php-cs-fixer describe array_syntax
```

## Reference
https://thewebtier.com/laravel/understanding-roles-permissions-laravel/
