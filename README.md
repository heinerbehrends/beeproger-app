# BeepRoger opdracht API server

REST api in Laravel ontwikkelt voor de BeepRoger opdracht. Maakt CRUD operaties mogelijk voor het Item model. Maakt gebruik van de Laravel Sail ontwikkelomgeving die op Docker gebaseerd is.

## Eerste stappen

Om de depencies te installleren maak gebruik van de volgende commando:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```

Voor meer informatie raadpleeg de [Laravel documentatie.](https://laravel.com/docs/8.x/sail#installing-composer-dependencies-for-existing-projects)

Om alle container te starten gebruik

```bash
sail up
# of start de processen op de achtergrond met
sail up -d
```

Gebruik sail in plaats van php om artisan commands te runnen.

```bash
# in plaats van bij voorbeeld
php artisan tinker
# gebruik je
sail artisan tinker
```

## De database migration uitvoeren

```bash
sail artisan migrate
```
