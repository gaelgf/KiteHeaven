Installation
========================

1. cloner le projet
2. lancer la commande dans le dossier du projet "composer install"
3. importer le fichier kiteheavenDump.sql dans votre BDD
4. puis lancer "php bin/console doctrine:schema:update --force"

Vous avez 2 comptes utilisateurs disponibles :
- login: johnDoe, pass: password
- login: admin, pass: admin (utilisateur avec les droits admmin)
