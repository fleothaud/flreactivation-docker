<?php
require('config.php'); // Assurez-vous d'inclure votre fichier de configuration pour la connexion à la base de données
$date_actuelle=floor(time()/86400);
if(isset($_POST['id_carte']) && !empty($_POST['id_carte'])) {
    $id_carte= $_POST['id_carte'];
    $id_data= $_POST['id_data'];
    $nom_classe= $_POST['nom_classe'];

    $data = [
      'id_data' => $id_data,
      'nom_classe'=>$nom_classe,
  ];
  $sql='SELECT * FROM flr_cartes WHERE id_data=:id_data AND nom_classe=:nom_classe';
  $req = $bdd->prepare($sql);
  $req->execute($data);
  $result = $req->fetchAll();
  foreach($result as $item)
  {
      $id_carte=$item['id'];
      $data = ['id_carte' => $id_carte,];
      $sql = 'DELETE FROM flr_reactivations WHERE id_carte = :id_carte';
      $req= $bdd->prepare($sql);
      $req->execute($data);
  }
  $data = [
      'id_data' => $id_data,
      'nom_classe' => $nom_classe,
      ];
  $sql = 'DELETE FROM flr_cartes WHERE id_data = :id_data AND nom_classe=:nom_classe';
  $req= $bdd->prepare($sql);
  $req->execute($data);
    
    echo json_encode(['status' => 'success', 'message' => 'Carte supprimée']);
    
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID carte manquant']);
}
?>
