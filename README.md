# FLReactivation-Docker

FLReactivation-Docker est une solution containerisée de FLReactivation, intégrant directement PHP et MySQL et phpMyAdmin. Conçue pour une déploiabilité aisée sur diverses plateformes grâce à Docker, elle permet une mise en œuvre rapide de flreactivation.

## Installation sur Raspberry Pi ([installation recommandée](Raspeberry.md))
1. Ouvrir une fenêtre de commande et éxecuter `ssh flreactivation` ou `ssh adresse_ip_serveur` pour vous connecter au Raspeberry PI
> [!TIP]
> Utiliser les informations d'authentification configurées à l'installation du Raspeberry PI

2. Executer les commandes suivantes: 

``` bash
apt update -y
apt full-upgrade -y
apt install docker docker-compose -y

git clone https://github.com/fleothaud/flreactivation-docker.git

cd flreactivation-docker

docker-compose up -d
```

Rendez-vous à l'adresse : http://flreactivation.local ou http://adresse_ip_serveur

## Linux

```
apt update -y
apt full-upgrade -y
apt install docker docker-compose -y

git clone https://github.com/fleothaud/flreactivation-docker.git

cd flreactivation-docker

docker-compose up -d
```

Rendez-vous à l'adresse :  http://adresse_ip_serveur

### Windows / Mac
1. Installer Git : https://git-scm.com/downloads
2. Installer docker desktop : https://www.docker.com/products/docker-desktop/
3. Ouvrir une fenetre de commande dans un repertoire qui contiendra l'application

```
git clone https://github.com/fleothaud/flreactivation-docker.git

cd flreactivation-docker

docker-compose up -d
```

Rendez-vous à l'adresse : http://adresse_ip_serveur





