# symportfolio-withdocker
Pour le suivi du porfolio développé par yoandev permettant d'observer les méthodologies d'intégration continue, le suivi en temps réel avec trello et surtout, c'est ce qui m'intéresse ici, l'utilisation de docker. 

## environnement de développement 
La base de données a été crée avec Docker :
symfony console make:docker:database
commande grâce à laquelle le client symfony va mettre en place à la racine du projet un docker-compose.yaml qui va dockeriser une base de donnée

on a ajouté un composant qui va intercepter les mails plutôt que d'utiliser un vrai serveur de mails, en ajoutant à docker.compose.yaml... 
    mailer:
        image: schickling/mailcatcher
        ports: [1025, 1080]

### pré-requis
PHP 7.4
Composer
Symfony CLI
Docker
Docker-compose

## lancer l'environnement de développement
```bash
docker-compose up -d
symfony serve -d
```

