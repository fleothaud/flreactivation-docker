# FLReactivation-Docker

FLReactivation-Docker est une solution containerisée de FLReactivation, intégrant directement PHP, MySQL et phpMyAdmin. Conçue pour une déploiabilité aisée sur diverses plateformes grâce à Docker, elle permet une mise en œuvre rapide de flreactivation sur un réseau local.

## Installation de l'environnement Docker

### Raspeberry / Linux : 

* Ouvrir une fenetre de commande sur la machine hôte :

`ssh fladmin@flreactivation` ou `ssh adminUser@adresse_ip_serveur`

> [!TIP]
> **Raspeberry PI :** 
> Utiliser les informations d'authentification configurées à [l'installation du Raspeberry PI](Raspeberry.md)


#### Mises à jour

``` bash
sudo apt update -y
sudo apt full-upgrade -y
```

#### Installation de l'environnement
``` bash
sudo apt install docker docker-compose micro git -y
```

### Windows / Mac : 
1. Installer Git : https://git-scm.com/downloads
2. Installer et executer docker desktop : https://www.docker.com/products/docker-desktop/


## Clonage FLReactivation-docker et installation

### Invite de commande

Toutes les opérations suivantes se font depuis une fenetre de commande en mode administrateur ou Super Utilisateur

#### Raspeberry/Linux :

* `ssh fladmin@flreactivation` ou `ssh adminUser@adresse_ip_serveur`

* `sudo su`

#### Windows

![479205_479217_common_14637_03](https://github.com/fleothaud/flreactivation-docker/assets/16253157/642e5a2a-ab6f-4d0e-a272-369eb4515cae)


#### MAC :

* Cliquez sur l’icône Launchpad  dans le Dock, saisissez Terminal dans le champ de recherche, puis cliquez sur Terminal.

* Dans le Finder , ouvrez le dossier /Applications/Utilitaires, puis cliquez deux fois sur Terminal.


### Clonage du Repo Github

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
> **Raspeberry/linux :**  `micro .env` ou `nano.env`:
> 
> **Windows/Mac :** Utiliser n'importe quel éditeur de texte

```
MARIADB_ROOT_PASSWORD=rootPassword # Personnaliser le mot de passe accès root
MARIADB_DB_NAME=flreactivation
MARIADB_DB_USER=fladmin
MARIADB_DB_PASSWORD=fladminPassword # Personnaliser le mot de passe de connexion pour base flreactivation
```

Une fois les modification faites Quitter et Sauvegarder les modifications

Construisez ensuite le conteneur

```
docker-compose up -d
```

>[!TIP]
>`docker-compose down` permet d'arrêter le docker
>
>`docker-compose start` permet de démarrer le docker déjà construit (executer `docker-compose up -d` pour les mises à jour)


Rendez-vous à l'adresse : http://flreactivation.local ou http://adresse_ip_serveur
pour continuer la [configuration](configuration.md)









