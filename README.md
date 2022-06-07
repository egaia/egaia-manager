<p align="center"><a href="https://egaia.fr" target="_blank"><img src="public/assets/logo-egaïa.png" width="100"></a></p>

# 🌱 EGAÏA APP

## 📄 Description

Egaïa est une application mobile qui accompagne au quotidien
les étudiants lyonnais à agir pour la planète.
Localisez les points de collecte proches de chez vous,
jetez vos déchets au bon endroit, chaque semaine,
relevez des défis afin de gagner des Gaïas
convertibles en codes promotionnels !

## 🔋 Lancement du projet

### Installation des dépendances

Lancez la commande `composer install`.

### Création de l'environnement

Après avoir créé votre base de données, vous pouvez configurer votre environnement :

* `cp .env.example .env` puis modifier les informations (connexion de la base de données)
* `php artisan key:generate` pour générer une clé dans votre `.env`
* `php artisan storage:link` pour lier votre dossier `storage` dans le dossier `public`
* `php artisan migrate` pour effectuer les migrations de la base de données

### Lancement

Lancez la commande `php artisan serve`.

Le serveur tournera en local sur le port `3000` par défaut. Le lien vers le back-office se trouvera dans votre terminal.

## 🧪 Bêta de l'application Egaïa

Une bêta est actuellement disponible si vous voulez essayez l'application.

Pour iOS : Vous pouvez essayer la bêta à l'aide de [TestFlight](https://apps.apple.com/fr/app/testflight/id899247664) en vous rendant sur le lien suivant : https://testflight.apple.com/join/zVo0PJUT

Pour android : Vous pouvez télécharger un apk de l'application à l'adresse suivante : https://fromsmash.com/Egaia-App-Android

Si vous rencontrez des bugs ou si vous avez des suggestions, vous pouvez nous en faire part à l'adresse suivante : `contact@egaia.fr`

## ⚙️ Application

Pour lancer l'application en local uniquement il vous faudra installer l'application en local, vous trouverez les instructions [ici](https://github.com/egaia/egaia-app).
