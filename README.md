# Postup setupu
1. Nainštalovať PHP a Composer
2. Clone repozitár
3. Zadať príkaz: "composer install"
4. Vytvoriť .env súbor podľa .env.example a zmeniť si databázu a údaje
5. Server sa zapne "php artisan serve" spustí sa na localhost:8000 server, mala by sa otvoriť landing page


# Kde sú zaujímavé súbory
## Šablony + komponenty
Sú v resources/views

## CSS a JS
Sú v public/css a public/js

## Routing stránok a medzi stránkami
Sú v routes/


## Controllery 
Sú v app/Http/Controllers

## Potrebné db extensions - bez nich nepôjde databáza
1. unaccent - na odstránenie diakritiky pri full-text search
- príkaz: CREATE EXTENSION IF NOT EXISTS unaccent;

2. pg_trgm - na indexovanie
- príkaz: CREATE EXTENSION IF NOT EXISTS pg_trgm;

