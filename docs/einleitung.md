# Einleitung

## Abhängigkeiten installieren

### Lokal

```
composer install
```

composer install --optimize-autoloader --no-dev

## Konfiguration erstellen lassen

```
cp .env.example .env
```

### Sprache

```
APP_LOCALE=fa
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=fa_IR
```

### Server

```
php artisan key:generate
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
