# Projet Tennix

![Logo](https://https://github.com/BenjaminP17/Tennix-Project/blob/main/public/images/illustration_dashboard.png)

Suivez votre palmarès tennis au fil des années, vos rencontres, compétitions jouées et l'évolution de votre classement.

## Pré-requis :white_check_mark:

- PHP 8.1
- MySQL
- Apache

## Installation

_Récupérer le projet_

```sh
git clone github.com/BenjaminP17/Tennix-Project
```

_Installer les dépendences_ 

```sh
composer install
```

_Configurer le fichier_ `.env`

`DATABASE_URL="mysql://UTILISATEUR:MOTDEPASSE@127.0.0.1:3306/NOMDELABDD?charset=utf8mb4"`

_Créer la base de données_

```sh
php bin/console doctrine:database:create
```

_Lancer le serveur local_

```sh
php symfony server:start
```

## Fonctionnalités développées

- Création de compte
- Modification Profil utilisateur
- Ajout d'une rencontre
- Ajout d'une compétition au calendrier
- Affichage Dashboard : classement actuel, prochaines compétitions, dernier match joué, stats (Victoire/Défaite) + % de victoire de l'année
- Evolution du classement sur l'année (à développer)

## Status du projet

![Static Badge](https://img.shields.io/badge/En%20cours-green)