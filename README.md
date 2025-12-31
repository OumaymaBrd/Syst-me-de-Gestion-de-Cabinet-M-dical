## Système de Gestion de Cabinet Médical

## Description
Ce projet est une migration d'une application de gestion de cabinet médical, passant d'une architecture PHP native procédurale à une architecture MVC (Modèle-Vue-Contrôleur). L'objectif est d'améliorer la modularité, la maintenabilité et la scalabilité du système.

## Contexte
Le cabinet médical utilise actuellement une application développée en PHP natif avec une approche procédurale. Cette migration vise à moderniser l'architecture pour faciliter les futures évolutions et améliorations.

## Objectifs
- Développer le code en suivant le modèle MVC pour une meilleure organisation.
- Créer un code lisible et maintenable en appliquant les bonnes pratiques (SOLID, DRY, etc.).
- Préparer la plateforme à intégrer de futures fonctionnalités.

## Fonctionnalités

### Structure MVC

#### Modèle (Model)
- Gestion des interactions avec la base de données (CRUD pour patients, médecins et rendez-vous).
- Implémentation des relations entre les entités.
- Utilisation de requêtes préparées pour la sécurité.

#### Vue (View)
- Templates réutilisables (header, footer, etc.).
- Design responsive.
- Validation côté client avec HTML5 et JavaScript natif.

#### Contrôleur (Controller)
- Gestion de la logique métier.
- Validation des données côté serveur.
- Gestion des sessions utilisateurs et des autorisations.

### Fonctionnalités Principales

#### Front Office
- Inscription et connexion des utilisateurs (patients et médecins).
- Prise de rendez-vous en ligne.
- Consultation de l'historique des consultations.

#### Back Office
- Gestion des utilisateurs.
- Gestion des rendez-vous (confirmation, annulation).
- Tableau de bord avec statistiques.

## Exigences Techniques
- Base de données : PostgreSQL
- Programmation Orientée Objet (POO)
- Sessions PHP pour la gestion des utilisateurs
- Validation des données côté serveur et client

## Architecture Technique
- Autoloading avec Composer
- Routing dynamique
- Configuration via .htaccess
- Séparation stricte des couches MVC

## Installation

1. Clonez le repository
