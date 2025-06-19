# TP TFT 2024-2025 Maxime CHARLET B1
[Lien vers le TP](http://grp-426.iq.iut21.u-bourgogne.fr/TpWeb/TFT/2024-2025-R3-01-B1-CHARLET/)
TP créé par [Nicolas 'Lomens' Resin](https://github.com/L0mens)

## I - Objectifs du TP (avec les validations)
- [x] Créer un projet et savoir le structurer (Architecture type MVCT (Model - Vue - Controller)).
- [x] Se familiariser avec le langage PHP (version 8.3).
- [x] Lier le projet à une base de données et jouer avec les données.
- [x] Faire des commits pertinents en conséquence.
- [ ] Développer le site de manière à ce qu'il soit responsive (adapté à différentes résolutions).
- [x] Gérer la navigation entre les pages.
- [ ] Un site accessible et adapté aux personnes ayant du mal à lire sur des couleurs non adaptées pour elles.

## II - Objectifs personnels

- [x] Inclure du JavaScript pour embellir le front ou faciliter la compréhension avec du dynamisme
- [ ] Voir pour intégrer une API (si possible)

## III - Technologies utilisées
- PHP 8.3
- MySQL (phpMyAdmin)
- JavaScript

## IV - Contexte du projet
- Représenter le jeu TFT créé par Riot Games pour permettre une compréhension assez simple en mélangeant les différentes exigences du TP à savoir les objectifs ci-dessus.
- Dans ce projet il faut :
  - Pouvoir ajouter, modifier et supprimer un personnage
  - Pouvoir ajouter, modifier, supprimer une origine
  - Créer un routeur permettant la navigation entre les pages
  - Récupérer les données pour les passer à une vue
 
## V - Installation
- Récupérer les fichiers du dépôt
- Récupérer le fichier .sql pour importer les données dans une base de données
- Initialiser la version de PHP en version 8.3
- Déploiement sur le GRP de l'IUT de Dijon

## VI - Arborescence du projet
```
MonProjet
|   .gitignore
|   .htaccess
|   index.php
|   README.md
|
+---app
|   +---Config
|   |       Config.php
|   |       dev.ini
|   |       dev_sample.ini
|   |
|   +---Controllers
|   |   |   Controller.php
|   |   |   MainController.php
|   |   |   OriginController.php
|   |   |   UnitController.php
|   |   |
|   |   \---Router
|   |       |   Route.php
|   |       |   Router.php
|   |       |
|   |       \---Routes
|   |               RouteAddOrigin.php
|   |               RouteAddUnit.php
|   |               RouteDeleteUnit.php
|   |               RouteEditUnit.php
|   |               RouteError.php
|   |               RouteIndex.php
|   |               RouteSearch.php
|   |
|   +---Exceptions
|   |       RouteException.php
|   |       RouterException.php
|   |
|   +---Helpers
|   |       Autoloader.php
|   |
|   +---Models
|   |   +---DAO
|   |   |       SearchDAO.php
|   |   |       UnitDAO.php
|   |   |
|   |   +---Database
|   |   |       BasePDODAO.php
|   |   |
|   |   \---Entity
|   |           Unit.php
|   |
|   +---Services
|   |       SearchManager.php
|   |       UnitManager.php
|   |
|   \---Views
|           add-origin.php
|           add-unit.php
|           errorPage.php
|           home.php
|           search.php
|           template.php
|
+---public
|   +---css
|   |   |   style.css
|   |   |
|   |   \---fonts
|   |           BeaufortforLOL-Medium.ttf
|   |
|   +---img
|   |   |   add-image.png
|   |   |   bannerNavbar.jpg
|   |   |   burgermenu.png
|   |   |   tftBackGround.jpg
|   |   |   tftBackGround.svg
|   |   |
|   |   \---characters
|   |           trueDamageAkali.jpg
|   |
|   \---js
|           script.js
|
\---vendor
    \---Plates

