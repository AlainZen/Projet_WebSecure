# 🔒 Projet WebSecure - Clone de Twitter en PHP

Bienvenue sur le dépôt de mon projet WebSecure réalisé en PHP. Ce projet consiste en la création d'un clone simplifié de Twitter, intégrant des fonctionnalités de sécurité telles que le hashage de mots de passe et la génération de tokens, ainsi qu'un système d'administration.

**Note :** Ce projet est réalisé dans le cadre d'un projet académique et reste en constante évolution. Certaines fonctionnalités sont encore en cours d'amélioration et seront enrichies au fil des mises à jour.


## 🚀 Fonctionnalités
- **Inscription et Connexion Sécurisées**
- - Hashage des mots de passe avec `password_hash()`
- - Vérification via `password_verify()`

- **Gestion des Tweets**
- - **Création :** Chaque utilisateur connecté peut publier un tweet.
- - **Modification et Suppression :** 
- - - Un **utilisateur** peut éditer ou supprimer ses propres tweets.
- - - Un **administrateur** peut gérer tous les tweets.

- **Système d'Administration**
- - Possibilité de s'inscrire directement en tant qu'**admin** sans passer par la base de données, pour simplifier les tests.
- - Accès aux fonctionnalités avancées de gestion des utilisateurs et des tweets.

## 🛠️ Technologies Employées

- **PHP :** Back-end sécurisé avec gestion des sessions.
- **MySQL :** Base de données pour stocker les utilisateurs et les tweets.
- **HTML/CSS :** Interface simple et fonctionnelle.

## 📦 Installation et Lancement

### 1️⃣ Cloner le Dépôt

```bash
git clone https://github.com/AlainZen/Projet_WebSecure.git
cd hash
``` 
### 2️⃣Configurer la base de données

- Importer le fichier `hash2.sql` dans votre base de données MySQL.

### 3️⃣Démarrer le serveur local (via Laragon, XAMPP, etc.)
```bash
http://localhost/Project_WebSecure
``` 


