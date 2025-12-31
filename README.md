# 🏥 Système de Gestion de Cabinet Médical

![Version](https://img.shields.io/badge/Version-Migration_MVC-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.0+-777bb4.svg?logo=php)
![PostgreSQL](https://img.shields.io/badge/Database-PostgreSQL-336791.svg?logo=postgresql)

## 📝 Description
Ce projet consiste en la **migration complète** d'une application de gestion de cabinet médical. L'objectif est de passer d'une architecture PHP native procédurale à une architecture **MVC (Modèle-Vue-Contrôleur)** afin d'améliorer la modularité, la maintenabilité et la scalabilité du système.

## 📌 Contexte
Le cabinet médical utilisait initialement une application développée en PHP natif avec une approche procédurale. Cette migration vers le pattern MVC permet de moderniser l'architecture, facilitant ainsi les futures évolutions et l'intégration de nouvelles fonctionnalités complexes.

## 🎯 Objectifs
* **Organisation :** Restructurer le code selon le modèle MVC.
* **Qualité :** Produire un code lisible et maintenable en appliquant les principes **SOLID** et **DRY**.
* **Évolutivité :** Préparer la plateforme à recevoir de nouveaux modules (ex: téléconsultation, facturation).

---

## 🏗️ Architecture du Système

Le projet est structuré en trois couches distinctes pour une séparation nette des responsabilités :

### 1. Modèle (Model)
* **Interactions BDD :** Gestion complète du CRUD pour les patients, médecins et rendez-vous.
* **Relations :** Implémentation de la logique relationnelle entre les entités.
* **Sécurité :** Utilisation systématique de requêtes préparées via PDO pour prévenir les injections SQL.

### 2. Vue (View)
* **Modularité :** Utilisation de templates réutilisables pour les éléments communs (header, footer, menus).
* **Interface :** Design responsive adapté à tous les types d'écrans.
* **Validation :** Validation des saisies côté client avec HTML5 et JavaScript natif.

### 3. Contrôleur (Controller)
* **Logique Métier :** Traitement centralisé des requêtes et pilotage des flux de données.
* **Sécurité Serveur :** Validation rigoureuse des données entrantes côté serveur.
* **Accès :** Gestion avancée des sessions utilisateurs et du contrôle des autorisations.

---

## ✨ Fonctionnalités Principales

### 🌐 Front Office
* **Authentification :** Inscription et connexion sécurisée pour les patients et les médecins.
* **Gestion des RDV :** Système de prise de rendez-vous en ligne.
* **Historique :** Consultation facilitée de l'historique des consultations passées.

### 🛠️ Back Office
* **Administration :** Gestion complète des comptes utilisateurs.
* **Pilotage :** Confirmation, report ou annulation des rendez-vous.
* **Statistiques :** Tableau de bord dynamique avec indicateurs clés d'activité.

---

## 🛠️ Spécifications Techniques
* **Langage :** PHP (Programmation Orientée Objet)
* **Base de données :** PostgreSQL
* **Gestion des accès :** Sessions PHP sécurisées
* **Dépendances :** Autoloading via **Composer**
* **Routage :** Routing dynamique avec configuration `.htaccess`

---

## 📂 Structure du projet
```text
├── app/
│   ├── Controllers/    # Logique de contrôle
│   ├── Models/         # Gestion des données
│   └── Views/          # Interface utilisateur
├── core/               # Noyau de l'application (Router, Database)
├── public/             # Point d'entrée (index.php, CSS, JS)
├── config/             # Fichiers de configuration
└── vendor/             # Dépendances Composer
