# Système de Gestion de Contenu: Wiki™

## Description
Ce projet vise à créer un système de gestionnaire de contenu efficace pour un wiki, associé à un front office, pour offrir une expérience utilisateur exceptionnelle. Il permettra une gestion aisée des catégories, des tags et des wikis, et offrira aux auteurs la possibilité de créer, modifier et supprimer leur contenu.

## Fonctionnalités Clés

### Partie Back Office

#### Gestion des Catégories (admin)
- Création, modification, suppression de catégories
- Association de plusieurs wikis à une catégorie

#### Gestion des Tags (admin)
- Création, modification, suppression de tags
- Association de tags aux wikis

#### Inscription des Auteurs
- Inscription avec informations de base (nom, e-mail, mot de passe)

#### Gestion des Wikis (auteurs et admins)
- Création, modification, suppression de wikis par les auteurs
- Association de catégories et tags aux wikis
- Archivage de wikis inappropriés par les admins

#### Tableau de Bord
- Statistiques des entités via le tableau de bord

### Partie Front Office

#### Login et Register
- Création de compte et connexion
- Redirection vers le tableau de bord ou la page d'accueil selon le rôle

#### Barre de Recherche
- Recherche de wikis, catégories, tags (AJAX)

#### Affichage des Derniers Wikis et Catégories
- Section dédiée sur la page d'accueil

#### Redirection vers la Page des Wikis
- Détails complets sur une page dédiée pour chaque wiki

## Technologies Requises

- Frontend: HTML5, Bootstrap, Javascript
- Backend: PHP 8, architecture MVC
- Database: PDO driver, MySQL

## Installation
1. Cloner le dépôt :
   ```
   git clone https://github.com/HMZElidrissi/Wiki.git
   ```
2. Naviguer vers le répertoire du projet :
   ```
   cd Wiki
   ```
3. Installer les dépendances Composer :
   ```
   composer install
   ```
4. Démarrer le serveur web PHP intégré :
   ```
   php -S localhost:8000 -t public
