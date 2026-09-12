# SOS Sauce

Application web de cuisine : parcourir des plats, suivre leurs recettes étape par étape (ingrédients, quantités, temps de préparation), gérer ses favoris, s'enregistrer/se connecter, et publier ses propres plats.

Le backend expose une API REST en Laravel, consommée par une SPA Vue 3 servie par une unique vue Blade (`resources/views/layout.blade.php`).

## Stack technique

**Backend**
- PHP 8.x / Laravel 8
- MySQL
- Laravel Sanctum (jetons d'API) + middlewares maison (`TokenVerify`, `ConnectedVerify`) pour l'authentification
- `fruitcake/laravel-cors` pour le CORS

**Frontend**
- Vue 3 + Vue Router 4
- Pinia (state management)
- Tailwind CSS
- vee-validate, @headlessui/vue, vue3-carousel
- Build via Laravel Mix (Webpack)

## Modèle de données

- **Meal** (plat) : nom, description, image, difficulté, temps, propriétaire (`user`)
- **Recipe** (étape de recette) : liée à un `Meal`, un `Ingredient` et une quantité, avec un numéro d'étape et une image
- **Ingredient**
- **Sauce**
- **User** : inscription/connexion, favoris (plats et sauces), avatar, profil

## Prérequis

- PHP 8.0+ et Composer
- MySQL (ou MariaDB)
- Node.js 18+ / npm

## Installation

```bash
# 1. Dépendances PHP
composer install

# 2. Fichier d'environnement
cp .env.example .env
php artisan key:generate

# 3. Configurer la base de données dans .env
# DB_DATABASE, DB_USERNAME, DB_PASSWORD selon votre installation MySQL

# 4. Créer la base (si elle n'existe pas)
mysql -u root -e "CREATE DATABASE sos_sauce CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 5. Migrations + données de démo
php artisan migrate --seed

# 6. Lien de stockage public (obligatoire pour afficher les images des plats)
php artisan storage:link

# 7. Dépendances JS puis build des assets
npm install
npm run dev

# 8. Lancer le serveur
php artisan serve
```

L'application est alors accessible sur http://127.0.0.1:8000.

> Les images des plats sont servies depuis `storage/app/public/meals`, exposé publiquement via le lien créé par `storage:link` (`public/storage`). Sans cette étape, les images ne s'affichent pas.

## Commandes Artisan essentielles

| Commande | Description |
|---|---|
| `php artisan serve` | Démarre le serveur de développement (http://127.0.0.1:8000) |
| `php artisan migrate` | Applique les migrations en attente |
| `php artisan migrate:fresh --seed` | Recrée toutes les tables et réinjecte les données de démo (⚠️ efface les données existantes) |
| `php artisan migrate:rollback` | Annule le dernier lot de migrations |
| `php artisan db:seed` | Réinjecte les seeders sans toucher au schéma |
| `php artisan key:generate` | Génère la clé d'application (`APP_KEY`) |
| `php artisan storage:link` | Crée le lien symbolique `public/storage` → `storage/app/public` (images) |
| `php artisan route:list` | Liste toutes les routes déclarées (web + API) |
| `php artisan tinker` | Ouvre une console REPL avec le contexte de l'application |
| `php artisan config:clear` | Vide le cache de configuration (utile après modification du `.env`) |
| `php artisan cache:clear` | Vide le cache applicatif |
| `php artisan test` | Lance la suite de tests PHPUnit |

## Commandes npm

| Commande | Description |
|---|---|
| `npm run dev` | Build de développement (une fois) |
| `npm run watch` | Build de développement avec rechargement à chaque modification |
| `npm run hot` | Build avec hot module replacement |
| `npm run prod` | Build de production (minifié) |

## Structure des routes API

Les routes API se trouvent dans `routes/api.php` (préfixe `/api`) : authentification (`/register`, `/login`, `/logout`), plats (`/meals`, `/meal/{slug}`), recettes (`/recipes/{slug}`), ingrédients, favoris et profil utilisateur. Le routage front (SPA) est géré côté Vue dans `resources/js/router/index.js`, toutes les routes web renvoyant vers la même vue (`routes/web.php`).
