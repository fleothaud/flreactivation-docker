<?php
$DBHOST='mysql';
$DBNAME='flreactivation';
$DBUSER='user';
$DBPSWD='password';
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
