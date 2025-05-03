# 📚 Bibliothèque Numérique de l'IAI

Ce projet est une application web de gestion et de consultation de documents académiques (mémoires, rapports de fin d'études, etc.) destinée à une institution académique. Il a été réalisé dans le cadre des Travaux Pratiques de Programmation Web à l'IAI.

## 👨‍💻 Réalisé par

- Florian TSUALA
- Hermine NGOMITAMACK

## 🎯 Objectif du projet

Permettre la mise en ligne, la recherche et la consultation de documents numériques par les étudiants, enseignants et administrateurs. L'application inclut un système d'authentification et des fonctionnalités d'administration pour gérer les documents, utilisateurs, cycles et enseignants superviseurs.

## ⚙️ Fonctionnalités principales

### Visiteurs
- 🔍 Recherche multicritère de documents
- 📖 Lecture et téléchargement de documents

### Utilisateurs authentifiés
- ➕ Ajout, modification, suppression de documents
- 👩‍🏫 Gestion des enseignants superviseurs
- 📚 Gestion des cycles
- 👤 Gestion des utilisateurs

## 🧰 Stack technique

- **Backend :** PHP (Programmation Orientée Objet, Sessions, Cookies)
- **Base de données :** MySQL
- **Frontend :** HTML5, CSS3, JS (Template personnalisé)
- **Environnement local :** Laragon
- **Éditeur :** Visual Studio Code
- **Navigateur recommandé :** Google Chrome

## 🗂 Organisation du projet

```
/Db             -> Scripts et export de la base de données
/Rapport        -> Documentation et rapport du projet
/Config         -> Fichiers de configuration
/core           -> Classes de base (architecture MVC simplifiée)
/lib            -> Librairies externes
/media          -> Fichiers uploadés (documents, images)
/partials       -> Fragments de pages (header, footer...)
```

## 🏁 Mise en place locale

### 1. Cloner le projet
```bash
git clone https://github.com/FlorianTSUALA/IAI_BIBLIO.git
```

### 2. Configuration
- Importer le script SQL (`iai_bibliotheque.sql`) dans votre base de données MySQL via phpMyAdmin ou autre.
- Modifier les paramètres de connexion à la base dans `/Config/db.php`.

### 3. Lancer le projet
Lancer Laragon et accéder au projet via `http://localhost/IAI_BIBLIO`.

## 🔐 Informations de test

- **Login :** `Prodigit`
- **Mot de passe :** `Prodigit7`

## 🧪 Aperçu

- Page d'accueil
- Interface de recherche
- Tableau de bord administrateur
- Fiches enseignants, utilisateurs, documents

## 📝 Conclusion

Ce projet a permis de mettre en pratique les connaissances en développement web full-stack, conception de base de données et architecture logicielle. Il constitue une base solide pour des projets similaires dans le domaine éducatif.

---

## 📄 Licence

Ce projet est à visée pédagogique. Toute utilisation commerciale est interdite sans autorisation.
