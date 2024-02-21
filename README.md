# FLRéactivation

FLRéactivation est une application basée sur un serveur PHP et MySQL, pouvant être facilement déployée sur différentes plateformes.

## Installation docker Engine

### Raspberry Pi (installation recommandée)
apt update -y
apt full-upgrade -y
apt install docker docker-compose -y

git clone https://github.com/fleothaud/flreactivation-docker.git

cd flreactivation-docker

docker-compose up -d

Rendez-vous à l'adresse : http://flreactivation.local ou http://adresse_ip_serveur

### Linux

apt update -y
apt full-upgrade -y
apt install docker docker-compose -y

git clone https://github.com/fleothaud/flreactivation-docker.git

cd flreactivation-docker

docker-compose up -d

Rendez-vous à l'adresse : http://flreactivation.local ou http://adresse_ip_serveur

### windows / Mac
installer docker desktop : https://www.docker.com/products/docker-desktop/

ouvrir une fenetre de commande dans un repertoire qui contiendra l'application

git clone https://github.com/fleothaud/flreactivation-docker.git

cd flreactivation-docker

docker-compose up -d

Rendez-vous à l'adresse : http://adresse_ip_serveur



### Sur Linux (Raspberry Pi)

Pour installer sur un Raspberry Pi, commencez par télécharger et installer le Raspberry Pi Imager :

- [Télécharger Raspberry Pi Imager](https://www.raspberrypi.com/software/)

Suivez les instructions d'installation fournies par l'outil. Voici quelques captures d'écran pour vous guider dans le processus :

![Étape 1](https://github.com/fleothaud/flreactivation/assets/16253157/3bff484e-0992-48ca-816d-ce103b9099b0)

![Étape 2](https://github.com/fleothaud/flreactivation/assets/16253157/403e2b73-c5c4-4acf-ab08-e8966531fa2d)

![Étape 3](https://github.com/fleothaud/flreactivation/assets/16253157/448d9662-84c4-4012-b2d9-7ae1c2424434)

![Étape 4](https://github.com/fleothaud/flreactivation/assets/16253157/e0f3e082-a477-4e2e-b6de-99cb6dc777b7)

![Étape 5](https://github.com/fleothaud/flreactivation/assets/16253157/e0fdcde4-e93a-4dfc-9287-34570162059c)

**Activer SSH :** Pour permettre l'accès SSH au Raspberry Pi, créez un fichier vide nommé `ssh` à la racine de la carte SD.

### Configuration initiale

1. Insérez la carte SD dans le Raspberry Pi connecté au réseau et démarrez-le.
2. Connectez-vous en SSH en utilisant la commande `ssh fladmin@flreactivation` depuis le terminal de commande, puis entrez le mot de passe configuré lors de la création de l'image.
3. obtenez l'adresse ip du raspeberry avec `ip -c a`
4. Exécutez les commandes suivantes pour mettre à jour le système et installer les composants nécessaires :

   ```bash
   sudo su
   apt update -y
   apt full-upgrade -y
   apt install apache2 php libapache2-mod-php mariadb-server php-mysql zip git php-curl php-gd php-intl php-json php-mbstring php-xml -y

   ```

### Configuration de phpMyAdmin
   ```
 apt install phpmyadmin
```

Lors de l'installation, il vous sera posé quelques questions auxquelles il faut répondre avec soin :

Choisir le serveur web apache2 (utiliser les flèches du clavier ou la touche tab pour se déplacer et la barre d'espace pour sélectionner/désélectionner) :
Le surlignage rouge n'est pas une sélection, il faut que ça affiche une étoile * entre les crochets, en utilisant la barre d'espace

![screenshot_20171028_125829](https://github.com/fleothaud/flreactivation/assets/16253157/f63ef282-7973-4ffc-be26-994112676db1)

Créer la base de données phpmyadmin : oui

![screenshot_20171028_112911](https://github.com/fleothaud/flreactivation/assets/16253157/980ec7a2-5a46-4007-8d7d-e0bd2bb15f72)


Définir un mot de passe pour l'utilisateur MySQL phpmyadmin :

![screenshot_20171028_112939](https://github.com/fleothaud/flreactivation/assets/16253157/634bfbb5-472d-4245-9385-5d8acf5c8b0b)


Indiquer le mot de passe de l'utilisateur MySQL « root »  : mot de passe configuré à l'installation

![screenshot_20171028_113015](https://github.com/fleothaud/flreactivation/assets/16253157/d0fe06d5-9252-4fbc-804c-481eb0070215)


### Création d'un utilisateur administrateur pour phpMyAdmin

```sql
sudo mysql
CREATE USER 'fladmin'@'localhost' IDENTIFIED BY 'votre mot de passe pour fladmin';
GRANT ALL PRIVILEGES ON *.* TO 'fladmin'@'localhost';
FLUSH PRIVILEGES;
QUIT;
```

Accédez à phpMyAdmin via : `http://flreactivation.local/phpMyAdmin` ou `http://adresse_ip_raspeberry/phpMyAdmin`, login : `fladmin` et mp : `votre mot de passe pour fladmin`

## Installation de FLRéactivation

1. Clonez le dépôt dans le répertoire web :

   ```bash
   cd /var/www/html/
   sudo git clone https://github.com/fleothaud/flreactivation.git
   sudo chown -R www-data:www-data /var/www/html/flreactivation
   ```

2. Créez la base de données et importez les tables :

   ```sql
   sudo mysql
   CREATE DATABASE flreactivation;
   exit;
   mysql -u fladmin -p flreactivation < /var/www/html/flreactivation/_install/flreactivation.sql
   ```

Entrez le mot de passe de l'utilisateur `fladmin` lorsque vous y êtes invité.

3. Mettre à jour le fichier de configuration

`sudo nano /var/www/html/flreactivation/config.php`

```
$DBHOST='localhost';
$DBNAME='flreactivation';
$DBUSER='fladmin';
$DBPSWD='password';
```
Quitter et sauvegarder : ctrl + X et Yes

4. Accédez à FLRéactivation via `http://flreactivation.local/flreactivation`   ou  `http://adresse_ip_raspeberry/flreactivation`

### Sur Windows

Pour installer un serveur PHP et MySQL sur Windows, téléchargez et installez WampServer depuis le site officiel :

- [Télécharger WampServer](https://www.wampserver.com/)

## Configuration de l'appli FLREACTIVATION

### Configuration acces administrateur

- En ligne de commande :
```
sudo mysql -u fladmin -p
```
saisir le mot de passe
```
USE flreactivation;
INSERT INTO `flr_users` (`login`, `password`, `statut`) VALUES ('login_admin', 'pass_admin', 'admin');
```
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
