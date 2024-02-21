<?php 
require("config.php");// pour connexion BDD et création table
date_default_timezone_set("Europe/Paris");//pour les fonctions date
session_start(); // initialisation session active jusqu"à deconnexion
$date_actuelle=floor(time()/86400);

?>
<!DOCTYPE html >
<html lang="fr">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/flr_css.css">
<script type="text/javascript" src="js/flr_js.js"></script>
<title>FLRéactivation</title>
<link rel="stylesheet" href="css/flreactivation.css">

<link rel="stylesheet" href="css/tinymce.css">
<script src="tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<script src="js/tynimce_perso.js" referrerpolicy="origin"></script>
<body>

<!-- DEBUT Div Conteneur-->
<div class = "conteneur" align="center"><?php

if(isset($_POST['modifier_parametres']))
{
  //$_SESSION=array();
  $_SESSION['modifier_parametres_niv']=$_POST['nom_niveau'];
  $_SESSION['modifier_parametres_cla']=$_POST['nom_classe'];


}
if(isset($_POST['modifier_affichage']))
{
  //$_SESSION=array();
  unset($_SESSION['modifier_affichage_niv']);
  $_SESSION['modifier_affichage_niv']=$_POST['nom_niveau'];
  $_SESSION['modifier_affichage_cla']=$_POST['nom_classe'];
}
$nom_niveau=$_POST['nom_niveau'];
$nom_classe=$_POST['nom_classe'];
$id_data=$_POST['id_data'];

?>

  <!--  /******************  MENU ************************************** */!-->
<div class="menu">
  <form method="POST" action="parametres.php">
  <input type='hidden' name='destroy'>
    <input type="image" src="./img/parametres.png" class='img_menu' >
  </form>
  <form method="POST" action="index.php">
  <input type='hidden' name='destroy'>
    <input type="image" src="./img/accueil.png" class='img_menu' >
  </form>
</div><?php



//validation modification carte
if(isset($_POST['valider_modification_carte']))
{
  $id_data=$_POST['id_data'];
  if(isset($_POST['choix_classes'])){ $choix_classes=$_POST['choix_classes'];}else
  {
    $choix_classes=array();
    echo 'On supprime tout ? <br>';
  }
  $question=$_POST['question_textarea'];
  $reponse=$_POST['reponse_textarea'];
  $nom_discipline=$_POST['choix_discipline'];
  $data = [
      'id_data'=>$id_data,
      'question' => $question,
      'reponse' =>$reponse,
      'nom_discipline' =>$nom_discipline,
  ];
  $sql = 'UPDATE flr_data SET question=:question, reponse=:reponse, nom_discipline=:nom_discipline WHERE id=:id_data';
  $req= $bdd->prepare($sql);
  $req->execute($data);
  $data = ['id_data' => $id_data,];

  $sql='SELECT * FROM flr_cartes WHERE id_data=:id_data';
  $req = $bdd->prepare($sql);
  $req->execute($data);
  $result = $req->fetchAll();
  foreach($result as $item)
  {
    $i=0;
    $nom_classe=$item['nom_classe'];
    
    foreach($choix_classes as $item)
    {
  
      if($nom_classe==$item){$i++;}else{}
    }
    if($i>0){echo $nom_classe.'On change pas';}else
    {
      echo $nom_classe.'on supprime';

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
          ];
      $sql = 'DELETE FROM flr_cartes WHERE id_data = :id_data';
      $req= $bdd->prepare($sql);
      $req->execute($data);
        }
    }
    foreach($choix_classes as $item)
    {
      $nom_classe=$item;
      $data = ["nom_classe" => $nom_classe,"id_data"=>$id_data,];
      $sql="SELECT * FROM flr_cartes WHERE nom_classe=:nom_classe AND id_data=:id_data" ;
      $req = $bdd->prepare($sql);
      $req->execute($data);
      $num_rows = $req->fetchColumn();
      if($num_rows>0){}else
      {
        echo $nom_classe.'on ajoute';
         $data = [
            'nom_classe' => $nom_classe,
            'id_data'=>$id_data
        ];
            $req = $bdd->prepare('INSERT INTO flr_cartes (id_data,nom_classe) VALUES (:id_data,:nom_classe)');
            $req->execute($data);

 
      }
    }
  if(isset($_SESSION['modifier_parametres_cla'])){header('location:parametres.php');}else{header('location:affichage.php');}
  
}
// aller à la page modification carte
if(isset($_POST['modifier_carte']))
{
  if(isset($_POST["id_carte"])){$id_carte=$_POST["id_carte"];}
  if(isset($_POST["id_data"])){$id_data=$_POST["id_data"];}

  $data = [
  "id_data" => $id_data,
  ];
  $sql="SELECT * FROM flr_data WHERE id=:id_data";
  $req = $bdd->prepare($sql);
  $req->execute($data);
  $result = $req->fetchAll();
  foreach($result as $item)
  {
  $question=$item["question"];
  $reponse=$item["reponse"];
  $nom_discipline=$item["nom_discipline"];
  $nom_niveau=$item["nom_niveau"];
  }
  ?>
  <div align="left">
  <form method="POST">
    <fieldset>
      <legend>Question</legend>
      <textarea type="text" id="file-picker" placeholder="Votre question" name="question_textarea" ><?php echo $question ?></textarea>
    </fieldset>
    <fieldset>
      <legend>Réponse</legend>
      <textarea type="text" id="file-picker" placeholder="Votre Reponse" name="reponse_textarea"><?php echo $reponse ?></textarea>
    </fieldset>
    <fieldset>
      <legend>Discipline</legend>
      <select name="choix_discipline">
      <option valeur="<?php echo $nom_discipline ?>"><?php echo $nom_discipline ?></option>
        <?php
        $sql="SELECT * FROM flr_disciplines ORDER BY nom_discipline ASC";
        $req = $bdd->prepare($sql);
        $req->execute();
        $result = $req->fetchAll();
          foreach($result as $item)
          {
            $nom_discipline=$item['nom_discipline'];?>  $nom_discipline
            
            <option valeur="<?php echo $nom_discipline ?>"><?php echo $nom_discipline ?></option>
            <?php
          }?>  
      </select></br>
    </fieldset>
    <fieldset>
      <legend>Classe(s)</legend><?php
      $data=['nom_niveau'=>$nom_niveau,];
  
      $sql="SELECT * FROM flr_classes WHERE nom_niveau=:nom_niveau";
      $req = $bdd->prepare($sql);
      $req->execute($data);
      $result = $req->fetchAll();
      foreach($result as $item)
      {
        $nom_classe=$item["nom_classe"];
        $data = ["nom_classe" => $nom_classe,"id_data"=>$id_data,];
        $sql="SELECT * FROM flr_cartes WHERE nom_classe=:nom_classe AND id_data=:id_data" ;
        $req = $bdd->prepare($sql);
        $req->execute($data);
        $num_rows = $req->fetchColumn();

        $nom_classe=$item["nom_classe"];?>
        <input type="hidden" name="id_data" value="<?php echo $id_data ?>">
        <input type="checkbox" name="choix_classes[]" value="<?php echo $nom_classe ?>"<?php if ($num_rows>0){echo "checked";}?>><?php echo $nom_classe ?></br><?php
      }?> 
    </fieldset>
      <input type="submit" name="valider_modification_carte" value="Valider modification">
  </form>
  </div>
 <?php
}
?>




  <!-- Fin div Conteneur-->
</div>

