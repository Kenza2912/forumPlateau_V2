# Forum Web Application

## Description

Ce projet est une application web de forum développée en PHP.
Elle permet aux utilisateurs de s'inscrire, de se connecter, de créer des sujets (topics), de publier des messages (posts) et de gérer leur profil. 
Cette application met également un accent particulier sur la sécurité, en intégrant des mesures pour protéger contre les failles de sécurité courantes.

## Fonctionnalités

- **Inscription et Connexion des utilisateurs** : Permet aux utilisateurs de créer un compte et de se connecter pour accéder aux fonctionnalités du forum.
- **Création, modification et suppression de sujets (topics)** : Les utilisateurs peuvent créer des sujets de discussion, les modifier ou les supprimer.
- **Publication, modification et suppression de messages (posts)** : Les utilisateurs peuvent publier des messages dans les sujets, les modifier ou les supprimer.
- **Gestion du profil utilisateur** : Affichage des sujets et messages créés par l'utilisateur connecté.
- **Anonymisation des données lors de la suppression** : Lorsqu'un administrateur supprime un compte, les contributions (sujets et posts) sont anonymisées pour préserver l'intégrité des discussions.
- **Interface utilisateur responsive** : UIkit est utilisé pour rendre l'interface agréable sur tous les types d'écrans, des mobiles aux ordinateurs de bureau.

## Technologies Utilisées

Voici les technologies principales utilisées dans ce projet :
- ![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
- ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
- ![UIkit](https://img.shields.io/badge/UIkit-2396F3?style=for-the-badge&logo=uikit&logoColor=white)
- ![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
- ![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
  

## Concepts Appris
Au cours de ce projet, plusieurs concepts importants ont été abordés et mis en pratique :

### 1. **MVC (Modèle-Vue-Contrôleur)**

L'architecture MVC a été utilisée pour structurer l'application, séparant ainsi la logique métier, la présentation, et le contrôle des interactions utilisateur.

### 2. **Gestion des Sessions**

Les sessions sont utilisées pour gérer l'authentification des utilisateurs. 
Elles permettent de conserver l'état de connexion des utilisateurs sur l'ensemble des pages du site, garantissant ainsi une expérience utilisateur fluide et sécurisée.

### 3. **Sécurité Web**

Des mesures de sécurité ont été mises en place pour protéger l'application et les données des utilisateurs :
- **Protection contre les failles XSS** : Toutes les données entrées par les utilisateurs sont échappées avant d'être affichées dans la vue pour empêcher l'exécution de scripts malveillants.
- **Protection contre les failles CSRF (Cross-Site Request Forgery)** : Des tokens CSRF sont générés et validés pour chaque formulaire soumis par l'utilisateur afin de garantir que les actions sont bien initiées par les utilisateurs autorisés.

- ### 4. **Gestion Sécurisée des Fichiers Uploadés**

Lors du traitement des fichiers uploadés par les utilisateurs, plusieurs pratiques de sécurité ont été mises en place :
- **Vérification du type de fichier** : Seuls les types de fichiers autorisés (images par exemple) sont acceptés, en se basant à la fois sur l'extension et le type MIME.
- **Limitation de la taille des fichiers** : Les fichiers trop volumineux sont rejetés pour éviter les abus et les attaques par déni de service.
- **Renommage des fichiers** : Les fichiers uploadés sont renommés de manière unique pour éviter les conflits de nommage et les problèmes de sécurité.


### 5. **Anonymisation des Données**

L'application implémente un mécanisme d'anonymisation des données pour préserver l'intégrité des discussions même après la suppression d'un compte utilisateur. 
Lorsqu'un utilisateur supprime son compte, ses contributions (sujets et posts) restent visibles, mais l'auteur est remplacé par un identifiant anonyme.


## Aperçu Visuel

### Page de Profil
### Page des Sujets
