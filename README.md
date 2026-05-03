## Fonctionnalité de matching

L'application intègre un système de matching inspiré des apps de rencontre.
Les utilisateurs répondent à une série de questions à choix binaire (option A ou B).
Sur la base de ces réponses, l'application identifie les profils ayant répondu de façon
identique et les affiche comme profils compatibles.

Depuis la page profil d'un utilisateur compatible, il est possible de le liker.
Un **match** se crée uniquement lorsque deux utilisateurs se sont mutuellement likés.
Retirer son like supprime le match automatiquement.

### Ce qui a été ajouté

- **Questions/réponses** — chaque utilisateur répond à une série de questions avant d'accéder aux fonctionnalités de matching
- **Profils compatibles** — affichage des utilisateurs ayant des réponses identiques
- **Like/Unlike** — action disponible uniquement depuis la page profil d'un utilisateur
- **Matches mutuels** — détection automatique lorsque deux utilisateurs se sont likés mutuellement
- **Page matches** — vue dédiée listant tous ses matches actuels
- **API REST versionnée** — endpoints `/api/v1/` avec gestion des scopes Sanctum (`profiles:read`, `likes:read`, `likes:write`, `matches:read`)
- **Middleware `has.answers`** — bloque l'accès aux fonctionnalités tant que l'utilisateur n'a pas répondu à toutes les questions


## Développement local

Pour développer et tester le projet en local, voici les étapes à suivre :

1. Cloner ce dépôt sur votre machine locale :

    ```bash
    git clone git@github.com:miniyankey/devprodmed-projet-eval-2.git

    cd devprodmed-projet-eval-2
    ```

2. Installer les dépendances avec npm et Composer :

    ```bash
    npm install && npm run build

    composer install
    ```

3. Copier le fichier `.env.example` en `.env` et modifier les variables d'environnement si nécessaire (optionnel).
4. Générer la clé d'application Laravel :

    ```bash
    php artisan key:generate
    ```

5. Créer le lien symbolique pour les fichiers téléversés :

    ```bash
    php artisan storage:link
    ```

6. Créer la base de données et exécuter les migrations :

    ```bash
    php artisan migrate
    ```

    S'il est nécessaire de réinitialiser la base de données, utiliser la commande `php artisan migrate:reset` puis `php artisan migrate` à nouveau.

7. Optionnel : en mode développement, il est possible de peupler la base de données avec des données fictives :

    ```bash
    php artisan db:seed
    ```

8. Démarrer le serveur de développement Laravel :

    ```bash
    composer run dev
    ```

L'application sera accessible à l'adresse <http://localhost:8000>.


## Utilisation de l'IA

L'IA (Claude) a été utilisée comme assistant de développement tout au long de l'implémentation
des fonctionnalités de matching. Elle n'a pas remplacé la logique métier définie au préalable,
mais a aidé à la traduire en code Laravel correct et cohérent.

### Conception de la structure de données

La structure des relations Eloquent (`likedUsers`, `likedByUsers`, `matches`) a été validée
et corrigée par l'IA. La relation `matches()` utilisant un `whereExists` pour détecter les
likes mutuels en une seule requête SQL a notamment été suggérée comme alternative plus
performante à une approche naïve en deux requêtes.

### Logique de compatibilité dans les contrôleurs

C'est là que l'IA a apporté le plus de valeur. La logique de filtrage des profils compatibles
dans `ProfileController@index` repose sur :

- La récupération des réponses de l'utilisateur connecté
- Le chargement en une seule requête de toutes les réponses des autres utilisateurs (`groupBy`)
- L'intersection des réponses communes avec `intersectByKeys`
- Le filtrage par réponses identiques avec `every`

Cette approche optimisée pour éviter le problème **N+1** (une requête SQL par utilisateur)
a été proposée et expliquée par l'IA.

### Vérification de compatibilité avant un like

Dans `UserLikeController@store`, la vérification que deux utilisateurs ont les mêmes réponses
avant d'autoriser un like a été construite avec l'IA, en réutilisant la même logique
d'intersection que dans le contrôleur de profils.

### Middleware `has.answers`

La décision de déplacer la vérification des réponses dans un middleware dédié plutôt que
de la dupliquer dans chaque contrôleur a été suggérée par l'IA, avec la gestion distincte
des réponses JSON (API) et des redirections (web).

### Ce qui a été fait sans l'IA

- La définition des migrations et de la structure de la base de données
- Le choix des règles métier (like uniquement depuis le profil, match = like mutuel)
- L'intégration dans les vues Blade existantes
- La configuration des scopes Sanctum et des tokens API
- Le débogage des erreurs (namespaces, guillemets manquants dans la vue)
