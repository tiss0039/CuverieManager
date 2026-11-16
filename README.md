# CuverieManager

**Gestion de cuverie · Laravel 11 · PHP · MySQL / SQLite**

Une application web pour centraliser les cuves, les moûts, les parcelles et les propriétaires d'une cuverie, avec des espaces adaptés aux différents métiers.

## À découvrir

- **Suivi des moûts** : volume, cuve, propriétaire et parcelle d'origine.
- **Gestion de la cuverie** : cuves, parcelles, employés et historique des actions.
- **Accès par rôle** : tableaux de bord et permissions pour administrateur, manager et caviste.

Le projet met en pratique la modélisation de données métier, les relations Eloquent, la validation des formulaires et le contrôle d'accès Laravel.

[Modèle conceptuel de données](diagrams/MCD.png) · [Diagramme de cas d'utilisation](diagrams/diagram.png)

## Fonctionnalités

- **Authentification** (Laravel Breeze) : connexion, inscription, mot de passe oublié et réinitialisation, vérification de l'adresse e-mail, page de profil (modification des informations, du mot de passe, suppression du compte).
- **Redirection selon le rôle** : après connexion, chaque utilisateur arrive sur le tableau de bord de son rôle.
- **Gestion des données (liste, ajout, modification, suppression)** :
  - **Cuves** : nom et volume maximum ;
  - **Moûts** : volume, type, propriétaire, cuve et parcelle d'origine (facultative ; elle doit appartenir au propriétaire sélectionné) ;
  - **Propriétaires** : nom ;
  - **Parcelles** : nom, localisation et propriétaire ;
  - **Employés** : nom, prénom, e-mail et rôle ;
  - **Rôles** : nom du rôle ;
  - **Historique** : actions saisies manuellement (type d'action, date, employé concerné).
- **Contrôle d'accès** par Gates Laravel (`app/Providers/AppServiceProvider.php`) appliquées aux routes (`routes/web.php`).

## Technologies

- **Back-end** : PHP 8.2+, Laravel 11, Laravel Breeze (authentification), Eloquent ORM
- **Base de données** : MySQL 8 ou SQLite
- **Front-end** : vues Blade ; Bootstrap 5 (chargé depuis un CDN) pour les pages de l'application ; Tailwind CSS compilé avec Vite pour les pages d'authentification Breeze
- **Tests** : PHPUnit (tests de fonctionnalités Laravel)

## Modélisation

- [Modèle conceptuel de données (MCD)](diagrams/MCD.png)
- [Diagramme de cas d'utilisation](diagrams/diagram.png)

Ces diagrammes correspondent à la conception. Quelques écarts avec l'implémentation :

- le lien entre l'historique et les cuves ou moûts (association « concerner ») n'est pas exploité : l'historique est relié uniquement à un employé ;
- la parcelle d'un moût (association « produire ») est facultative dans l'application, afin de rester compatible avec les moûts enregistrés sans parcelle ;
- le moût est également relié directement à un propriétaire.

## Rôles et droits d'accès

| Section | Administrateur | Manager | Caviste |
|---|:---:|:---:|:---:|
| Rôles, Employés, Cuves | ✅ | — | — |
| Propriétaires, Parcelles, Historique | ✅ | ✅ | — |
| Moûts | 👁️ lecture seule | — | ✅ |
| Profil | ✅ | ✅ | ✅ |

L'Administrateur dispose de tous les droits (`Gate::before`) ; pour les moûts, l'interface lui présente toutefois la liste en lecture seule, l'ajout, la modification et la suppression étant réservés au Caviste. Un accès non autorisé renvoie une erreur 403.

Un compte créé via la page d'inscription n'a pas de rôle : il est authentifié mais reçoit une page 403 (« Aucun rôle ne vous a été attribué ») tant qu'aucun rôle ne lui est attribué. Il n'existe pas encore d'interface pour attribuer un rôle à un compte utilisateur (voir [Limites connues](#limites-connues)).

## Prérequis

- PHP 8.2 ou supérieur, avec les extensions habituelles de Laravel et `pdo_sqlite` ou `pdo_mysql`
- [Composer](https://getcomposer.org/)
- Node.js 18, 20 ou 22+ et npm
- MySQL 8 (facultatif : SQLite est utilisé par défaut)

## Installation

```bash
git clone https://github.com/tiss0039/CuverieManager.git
cd CuverieManager

# Dépendances PHP
composer install

# Configuration
cp .env.example .env
php artisan key:generate

# Dépendances front-end et compilation des assets (Vite)
npm ci
npm run build
```

La commande `npm run build` est **obligatoire** : les pages d'authentification chargent leur feuille de style via Vite (`public/build`). Sans elle, ces pages et les tests correspondants échouent avec l'erreur « Vite manifest not found ». Pendant le développement, `npm run dev` peut être lancé à la place pour recompiler automatiquement.

### Base de données

**Option 1 – SQLite (configuration par défaut de `.env.example`)**

```bash
touch database/database.sqlite
php artisan migrate --seed
```

Sous Windows, créez simplement un fichier vide `database/database.sqlite` au lieu d'utiliser `touch`.

**Option 2 – MySQL**

Créez une base de données vide (par exemple `cuverie`), puis renseignez la connexion dans `.env` :

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cuverie
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

```bash
php artisan migrate --seed
```

Pour repartir d'une base vide avec les données de démonstration (⚠️ supprime toutes les données existantes) :

```bash
php artisan migrate:fresh --seed
```

## Lancement

```bash
php artisan serve
```

L'application est accessible sur <http://127.0.0.1:8000> ; la page d'accueil redirige vers la page de connexion.

Les e-mails (réinitialisation du mot de passe, vérification) ne sont pas envoyés en local : avec `MAIL_MAILER=log`, ils sont écrits dans `storage/logs/laravel.log`.

## Comptes de démonstration

Créés par `php artisan migrate --seed` (`database/seeders/UserSeeder.php`) :

| Rôle | E-mail | Mot de passe |
|---|---|---|
| Administrateur | `admin@example.com` | `password123` |
| Manager | `manager@example.com` | `password123` |
| Caviste | `caviste@example.com` | `password123` |

Ces identifiants sont uniquement destinés au développement local.

Les seeders créent également des données d'exemple : 3 cuves, 2 moûts, 2 propriétaires, 3 parcelles, 2 employés et 2 entrées d'historique.

## Tests

Les assets doivent avoir été compilés au préalable (`npm run build`).

```bash
php artisan test
```

Les tests s'exécutent toujours sur une base SQLite en mémoire dédiée, définie dans `phpunit.xml` : ils ne modifient jamais la base de développement, même si `.env` ou les variables d'environnement du shell pointent vers MySQL.

Un garde-fou (`tests/TestCase.php`) interrompt les tests avant toute opération sur la base si la configuration Laravel est en cache (`php artisan config:cache`, qui ferait ignorer les réglages de `phpunit.xml`) ou si la connexion effective n'est pas cette base SQLite en mémoire. Dans le premier cas, exécutez `php artisan config:clear` puis relancez les tests.

Les tests couvrent notamment l'authentification (Breeze), la redirection selon le rôle et la réponse 403 pour un compte sans rôle (`tests/Feature/RoleAccessTest.php`), la création et la modification des employés (`tests/Feature/EmployeTest.php`), l'association d'un moût à une parcelle du bon propriétaire (`tests/Feature/MoutParcelleTest.php`) et l'exécution complète des seeders (`tests/Feature/DatabaseSeederTest.php`).

## Structure du projet

```text
app/Http/Controllers/   Contrôleurs (Cuve, Mout, Proprietaire, Parcelle, Employe, Role, Historique)
app/Http/Requests/      Règles de validation des formulaires
app/Models/             Modèles Eloquent
app/Providers/          Définition des Gates (droits par rôle)
database/migrations/    Structure de la base de données
database/seeders/       Données de démonstration
resources/views/        Vues Blade (tableaux de bord par rôle, CRUD, authentification)
routes/web.php          Routes et restrictions d'accès
tests/Feature/          Tests de fonctionnalités
diagrams/               MCD et diagramme de cas d'utilisation
```

## Limites connues

- Aucune interface ne permet d'attribuer un rôle à un compte utilisateur : les comptes avec rôle sont créés par les seeders. Les employés (table `employes`) sont distincts des comptes de connexion (table `users`).
- Le volume d'un moût n'est pas comparé au volume maximum de la cuve.
- L'historique est saisi manuellement ; il n'est pas alimenté automatiquement par les actions effectuées.
- Les pages d'authentification Breeze sont en anglais et utilisent Tailwind CSS, alors que le reste de l'application est en français et utilise Bootstrap.

## Auteur

Ela Tissaoui
