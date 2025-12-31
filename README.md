# 🏥 Système de Gestion de Cabinet Médical (Migration MVC)

[![PHP Version](https://img.shields.io/badge/PHP-8.0+-777bb4.svg?style=flat-square&logo=php)](https://www.php.net/)
[![Database](https://img.shields.io/badge/Database-PostgreSQL-336791.svg?style=flat-square&logo=postgresql)](https://www.postgresql.org/)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](LICENSE)

## 📝 Description
Ce projet est une migration d'une application de gestion de cabinet médical, passant d'une architecture PHP native procédurale à une architecture **MVC (Modèle-Vue-Contrôleur)** personnalisée. L'objectif est d'améliorer la modularité, la maintenabilité et la sécurité du système.



[Image of MVC architectural pattern diagram]


## 📌 Contexte & Objectifs
L'ancienne version du système reposait sur du PHP procédural, ce qui rendait les mises à jour difficiles. Cette migration vise à :
* **Structurer le code** en suivant le modèle MVC.
* **Appliquer les bonnes pratiques** de développement (POO, SOLID, DRY).
* **Sécuriser les données** patients et médecins via des requêtes préparées.
* **Améliorer l'expérience utilisateur** avec une interface responsive.

---

## 🏗️ Architecture du Projet
L'application est découpée selon une structure logique stricte :

* **Modèle (`models/`) :** Contient les entités (Patient, Médecin, Rendez-vous) et la logique d'interaction avec **PostgreSQL**.
* **Contrôleur (`controllers/`) :** Gère la logique métier, traite les formulaires et dirige les flux de données.
* **Vue (`views/`) :** Contient les fichiers d'affichage et les templates réutilisables (header, footer).
---

## ✨ Fonctionnalités

### 👥 Gestion des Utilisateurs
* **Inscription & Connexion :** Authentification sécurisée pour les patients et les médecins.
* **Profils :** Gestion des informations personnelles et spécialités.

### 📅 Gestion Médicale
* **Prise de RDV :** Système de réservation en ligne pour les patients.
* **Suivi des Consultations :** Consultation de l'historique médical.
* **Gestion Administrative :** Confirmation ou annulation des rendez-vous via le Back Office.

### 📊 Tableau de Bord
* Visualisation des statistiques du cabinet.
* Gestion centralisée des utilisateurs et des ressources.

---

## 🛠️ Spécifications Techniques
* **Langage :** PHP 8+ (Programmation Orientée Objet).
* **Base de données :** PostgreSQL.
* **Gestion des Sessions :** Sécurisation des accès utilisateurs.
* **Frontend :** HTML5, CSS3, JavaScript (Validation côté client).
* **Serveur :** Configuration via `.htaccess` pour le routing.

---

## 📂 Structure des Dossiers
```text
├── Config/            
├── controllers/            
├── models/            
├── public/             
├── views/                      

