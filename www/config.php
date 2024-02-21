<?php
$DBHOST= getenv('DB_HOST');
$DBNAME=getenv('DB_NAME');
$DBUSER=getenv('DB_USER');
$DBPSWD=getenv('DB_PASSWORD');
try
{
    $bdd = new PDO('mysql:host='.$DBHOST.';dbname='.$DBNAME, $DBUSER, $DBPSWD);
}
catch(PDOException $e){
    printf('Échec de la connexion');
    echo '<br>';
    printf('message erreur system: %s', $e->getMessage());
    exit();
}
