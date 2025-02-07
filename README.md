# Gestion de Tournoi - Symfony

## Prérequis
Vous devez utiliser :  
* PHP 8.1 ou supérieur  
* Symfony 6  
* Composer  
* MySQL ou PostgreSQL  
* Node.js & npm (pour les assets)  

## Installation

### Cloner le dépôt
```bash
git clone https://github.com/votre-repo/tournoi-symfony.git
cd tournoi-symfony
```

### Installer les dépendances PHP
```bash
composer install
```

### Installer les dépendances front-end
```bash
npm install
```

### Configurer l'environnement
Dupliquez le fichier `.env` en `.env.local` et configurez votre base de données :
```env
DATABASE_URL="mysql://user:password@127.0.0.1:3306/tournoi_db"
```

### Créer la base de données
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### Charger les fixtures (optionnel)
```bash
php bin/console doctrine:fixtures:load
```

### Lancer le serveur Symfony
```bash
symfony server:start
```

### Compiler les assets
```bash
npm run dev
```

## Fonctionnalités
- Inscription & connexion utilisateur
- Gestion des tournois (création, inscription, suivi)
- Système d'équipe
- Back-office administrateur (gestion utilisateurs, tournois...)

## Comment jouer
- Inscrivez-vous et connectez-vous.
- Rejoignez ou créez une équipe.
- Inscrivez votre équipe à un tournoi.
- Suivez les matchs et progressez vers la victoire !

## Auteur
By Erwan AGESNE
