<?php
require('config.php'); // Assurez-vous d'inclure votre fichier de configuration pour la connexion à la base de données
$date_actuelle=floor(time()/86400);
if(isset($_POST['id_carte']) && !empty($_POST['id_carte'])) {
    $date_reac=$date_actuelle;
    $id_carte= $_POST['id_carte'];
    // $id_data= $_POST['id_data'];

    $data = [
        'id_carte' => $id_carte,
        'date_reac'=>$date_reac,
    ];
    $sql = 'UPDATE flr_cartes SET nb_reac=Coalesce(nb_reac,0)+1, date_reac=:date_reac  WHERE id=:id_carte';
    $req= $bdd->prepare($sql);
    $req->execute($data);

    $data = [
    'id_carte' => $id_carte,
    ];
    $sql='SELECT * FROM flr_cartes WHERE id=:id_carte';
     $req = $bdd->prepare($sql);
    $req->execute($data);
    $result = $req->fetchAll();
    foreach($result as $item)
    {
      $nb_reac=$item['nb_reac'];
      $date_reac=$item['date_reac'];
    }
    $data = [
        'id_carte' => $id_carte,
        'nb_reac' => $nb_reac,
        'date_reac' => $date_reac,
    ];
        $req = $bdd->prepare('INSERT INTO flr_reactivations (id_carte,nb_reac,date_reac) VALUES (:id_carte,:nb_reac,:date_reac)');
        $req->execute($data);
    echo json_encode(['status' => 'success', 'message' => 'Carte validée']);

} else {
    echo json_encode(['status' => 'error', 'message' => 'ID carte manquant']);
}
?>
