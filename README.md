The idea : a dating app with 6 questions of person preferences and only two response for each one.
After, the application recommend account with the same preferences. And people can like account base on the picture profile, the description, the name and the age.
Questions list : 
milk before or after cereales ?
shower on evening or on morning ?
more mountains or beach ?
Are you more homebody or be outside ?
Do you prefere Windows or Mac ?
Do you validate tap shoes and socks ?


## Développement local

Pour développer et tester le mini-projet en local, voici les étapes à suivre :

1. Cloner ce dépôt sur votre machine locale :

    ```bash
    git clone git@github.com:heig-vd-devprodmed-course-2025-2026/devprodmed-evaluation-1-miniyankey.git

    cd devprodmed-evaluation-1-miniyankey
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
