# FLReactivation-Docker

FLReactivation-Docker est une solution containerisée de FLReactivation, intégrant directement PHP, MySQL et phpMyAdmin. Conçue pour une déploiabilité aisée sur diverses plateformes grâce à Docker, elle permet une mise en œuvre rapide de flreactivation.

## Installation sur Raspberry Pi ([Installation recommandée](Raspeberry.md))

### Connexion au Raspeberry

* Ouvrir une fenêtre de commande et éxecuter `ssh fladmin@flreactivation` ou `ssh fladmin@adresse_ip_serveur` pour vous connecter au Raspeberry PI
> [!TIP]
> Utiliser les informations d'authentification configurées à l'installation du Raspeberry PI


### Mises à jour

``` bash
sudo apt update -y
sudo apt full-upgrade -y
```

### Installation de l'environnement docker
``` bash
sudo apt install docker docker-compose micro -y
```

### clonage FLReactivation-docker

``` bash
git clone https://github.com/fleothaud/flreactivation-docker.git
``` 
### Construction du Docker
* Aller à la racine du repertoire **flractivation-docker**

``` bash
cd flreactivation-docker
``` 

> [!WARNING]
> Personnalisez les mots de passe d'accés mysql (base de données) en éditant le fichier .env

> [!TIP]
> Raspeberry/linux :  `micro .env`:
> Windows/Mac: Utiliser notepad par exemple

```
MYSQL_ROOT_PASSWORD=rootPassword # Personnaliser le mot de passe accès root
MYSQL_DB_NAME=flreactivation
MYSQL_DB_USER=fladmin
MYSQL_DB_PASSWORD=fladminPassword # Personnaliser le mot de passe de connexion pour base flreactivation
```

Une fois les modification faites `ctrl+Q` pour quitter et `y` pour sauvegarder les modifications

Construsez ensuite le conteneur

```
sudo docker-compose up -d
```

Rendez-vous à l'adresse : http://flreactivation.local ou http://adresse_ip_serveur

[Configuration](configuration.md)

## Linux

```
apt update -y
apt full-upgrade -y
apt install docker docker-compose micro -y

git clone https://github.com/fleothaud/flreactivation-docker.git

cd flreactivation-docker

```
> [!TIP]
> Personnaliser les mots de passe d'accés mysql (base de données) en éditant le fichier .env :

```
MYSQL_ROOT_PASSWORD=rootPassword # Personnaliser le mot de passe accès root
MYSQL_DB_NAME=flreactivation
MYSQL_DB_USER=fladmin
MYSQL_DB_PASSWORD=fladminPassword # Personnaliser le mot de passe de connexion pour base flreactivation
```

Une fois les modification enregistrées démarrer le conteneur :

```
docker-compose up -d
```

Rendez-vous à l'adresse :  http://adresse_ip_serveur

[Configuration](configuration.md)

### Windows / Mac
1. Installer Git : https://git-scm.com/downloads
2. Installer docker desktop : https://www.docker.com/products/docker-desktop/
3. Ouvrir une fenetre de commande dans un repertoire qui contiendra l'application

```
git clone https://github.com/fleothaud/flreactivation-docker.git

cd flreactivation-docker

```
>[!TIP]
>Personnaliser les mots de passe d'accés mysql (base de données) en éditant le fichier .env :

```
MYSQL_ROOT_PASSWORD=rootPassword # Personnaliser le mot de passe accès root
MYSQL_DB_NAME=flreactivation
MYSQL_DB_USER=fladmin
MYSQL_DB_PASSWORD=fladminPassword # Personnaliser le mot de passe de connexion pour base flreactivation
```

Une fois les modification enregistrées démarrer le conteneur :

```
docker-compose up -d
```

Rendez-vous à l'adresse : http://adresse_ip_serveur 

[Configuration](configuration.md)





