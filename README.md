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





- Depuis phpMyAdmin
![2024-02-19_16h38_16](https://github.com/fleothaud/flreactivation/assets/16253157/3354ca42-9198-4279-bdaa-7e13a3f957dd)

## Paramétrage

http://flreactivation.local/flreactivation   ou  http://adresse_ip_raspeberry/flreactivation

![2024-02-19_19h05_28](https://github.com/fleothaud/flreactivation/assets/16253157/ffb33080-3de7-401b-a566-3b616eb9f539)


![2024-02-19_19h07_27](https://github.com/fleothaud/flreactivation/assets/16253157/5a231186-92e8-48c2-bdde-e73326c7ba4f)

   **1. Commencer par ajouter les différents niveaux de votre établissement : 6eme, 5eme, ...**
      
   ![2024-02-19_19h09_33](https://github.com/fleothaud/flreactivation/assets/16253157/e6dafe45-0af1-4437-84a5-9f61d9670228)

   **2. Ajouter les classes**
      
   ![2024-02-19_19h10_13](https://github.com/fleothaud/flreactivation/assets/16253157/6cae0fd2-0b29-42fd-a1b1-ad4020c3ff89)

   **3. Ajouter des disciplines**
      
   ![2024-02-19_19h11_12](https://github.com/fleothaud/flreactivation/assets/16253157/c2709bc9-9147-40f0-b922-f42bdb370cba)

   **4. Configurer les paramètres de réactivation**
      
   ![2024-02-19_19h11_52](https://github.com/fleothaud/flreactivation/assets/16253157/790460c1-5d6d-476b-8e20-aebddb11d0d4)

   **5. Naviguez depuis la page d'accueil jusqu'à une classe et commencer à ajouter des questions**
      
   ![2024-02-19_19h12_52](https://github.com/fleothaud/flreactivation/assets/16253157/9044da30-bca5-4c83-9778-b61fd14f8bff)

   ![2024-02-19_19h16_13](https://github.com/fleothaud/flreactivation/assets/16253157/ce00a730-d6fd-41b3-a00a-df8fb1cbec97)

   **6. La carte apparait dans l'espace des classes concernées, la réactivation peut commencer**
![2024-02-19_19h17_03](https://github.com/fleothaud/flreactivation/assets/16253157/74baddc7-b525-45d0-b183-4319eaa2576b)
