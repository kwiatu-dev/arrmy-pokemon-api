## Instalacja i Konfiguracja

Postępuj zgodnie z poniższymi krokami, aby uruchomić projekt na lokalnej maszynie.

### 1. Klonowanie repozytorium
git clone https://github.com/kwiatu-dev/arrmy-pokemon-api
cd arrmy-pokemon-api

### 2. Instalacja zależności
composer install

### 3. Konfiguracja środowiska (.env)
cp .env.example .env

### 4. Generowanie klucza aplikacji i migracje
php artisan key:generate
php artisan migrate

### 5. Uruchomienie serwera
php artisan serve