<?php 
require('config.php');// pour connexion BDD et création table
date_default_timezone_set('Europe/Paris');//pour les fonctions date
session_start(); // initialisation session active jusqu'à deconnexion
$date_actuelle=floor(time()/86400);
if(isset($_POST['destroy'])){$_SESSION = array();}
?>
<!DOCTYPE html >
<html lang="fr">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/flr_css.css">
<script type="text/javascript" src="js/flr_js.js"></script>
<title>FLRéactivation</title>

<link rel="stylesheet" href="css/tinymce.css">
<script src="tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<script src="js/tynimce_perso.js" referrerpolicy="origin"></script>
<body>
<div class='conteneur' align="center">
<?php
 if(isset($_SESSION['ajout_classes_niv'])){$nom_niveau=$_SESSION['ajout_classes_niv'];}
 if(isset($_SESSION['ajout_affichage_niv']))
 {
     $nom_niveau=$_SESSION['ajout_affichage_niv'];
     $nom_classe=$_SESSION['ajout_affichage_cla'];
 
     $_SESSION['ajout_affichage_niv']=$nom_niveau;
     $_SESSION['ajout_affichage_cla']=$nom_classe;

 }

 if(isset($_SESSION['modifier_affichage_niv'])){$nom_niveau=$_SESSION['modifier_affichage_niv'];}
 if(isset($_SESSION['modifier_affichage_cla'])){$nom_classe=$_SESSION['modifier_affichage_cla'];}


    if(isset($_SESSION['ajout_classes_niv'])){$nom_niveau=$_SESSION['ajout_classes_niv'];}
    if(isset($_SESSION['ajout_affichage_niv'])){$nom_niveau=$_SESSION['ajout_affichage_niv'];}
    if(isset($_POST['nom_niveau'])){$nom_niveau=$_POST['nom_niveau'];}
    if(isset($_SESSION['ajout_affichage_cla'])){$nom_classe=$_SESSION['ajout_affichage_cla'];}
    if(isset($_POST['nom_classe'])){$nom_classe=$_POST['nom_classe'];}
   
 
    ?>
  <!--  /******************  MENU ************************************** */!-->
<div class='menu'>

  <form method='POST' action='index.php'>
  <input type='hidden' name='destroy'>
    <input type='image' src="./img/accueil.png" class='img_menu' >
  </form>
  <form method='POST' action='ajouter.php'>
        <input type='hidden' name='ajout_affichage'>
        <input type="hidden" name="nom_niveau" value="<?php echo $nom_niveau ?>">
        <input type="hidden" name="nom_classe" value="<?php echo $nom_classe ?>">
        <input type='image' src="./img/ajouter.png" class='img_menu' >
      </form>
</div>
<div class="menu_context" align="center">
<h1><?php echo $nom_classe ?></h1>
</div>
  <!--  /******************  FIN MENU ************************************** */!-->

<?php


// cherche le num_reac_max ds parametres reactivations
$sql='SELECT * FROM flr_parametres_reactivations ORDER BY num_reac ASC';
$req = $bdd->prepare($sql);
$req->execute();
$result = $req->fetchAll();
foreach($result as $item)
{
    $num_reac_max=$item['num_reac'];
}

$nb_cartes=0;// pour compter les cartes qui s'affichent

// selection des cartes de la classe
$data = [
            'nom_classe' => $nom_classe,
        ];
$sql='SELECT * FROM flr_cartes WHERE nom_classe=:nom_classe ORDER BY id';
$req = $bdd->prepare($sql);
$req->execute($data);
$result = $req->fetchAll();
    foreach($result as $item)
    {
      $id_carte=$item['id'];
      $id_data=$item['id_data'];
      $nom_classe=$item['nom_classe'];
      $date_reac=$item['date_reac'];
      $nb_reac=$item['nb_reac'];
      $afficher_reponse=$item['afficher_reponse'];
      $mise_en_ligne=$item['mise_en_ligne'];
  

      // calcul s'il faut afficher ou pas
      if ($nb_reac<1) 
      {
          $afficher=1;
      }
      elseif ($nb_reac<=$num_reac_max)
      {
          $num_reac=$nb_reac;
          $data = [
          'num_reac' => $num_reac,
          //'prenom' => $prenom,
          ];
          $sql='SELECT * FROM flr_parametres_reactivations WHERE num_reac=:num_reac';
          $req = $bdd->prepare($sql);
          $req->execute($data);
          $result = $req->fetchAll();
          foreach($result as $item)
          {
          $duree_reac=$item['duree_reac'];
          }
          if ($date_reac+$duree_reac<=$date_actuelle) {
              $afficher=1;
          }
          else {
              $afficher=0;
          }
      }
      else 
      {
          $afficher=0;
      }

      // affichage des cartes
      if($afficher==1)
      {
        $nb_cartes++;
        ?>
        <table class="tableau_affichage_cartes" id="question-<?php echo $id_carte; ?>"><?php
       
        $data = [
                    'id_data' => $id_data,
                ];
        $sql='SELECT * FROM flr_data WHERE id=:id_data';
        $req = $bdd->prepare($sql);
        $req->execute($data);
        $result = $req->fetchAll();
        foreach($result as $item)
        {
          $question=$item['question'];
          $reponse=$item['reponse'];
          $nom_discipline=$item['nom_discipline'];
          $nom_niveau=$item['nom_niveau'];
          
          ?>
  
          <tr  >
            <td rowspan='3' class='td_tab_input_affichage'>
              <font size="+1" color='blue'>
              <?php echo  $nom_discipline ?><br>
              </font>
              <div class="question">
              <?php echo  $question;?>
             </div>
             <font size="-1" id="info-<?php echo $id_carte; ?>">
                  <?php $mise_en_ligne_ddmmyy=date('d-m-Y', $mise_en_ligne*86400);
                        $date_reac_ddmmyy=date('d-m-Y', $date_reac*86400);
                   echo  'mise en ligne le : '.$mise_en_ligne_ddmmyy.'<br>';
                   if($nb_reac==NULL){echo 'pas encore réactivé'.'<br>';}else{echo 'réactivé '.$nb_reac.' fois'.'<br>'.'derniere réactivation le : '.$date_reac_ddmmyy ;}
                   ?>
              </font>
             <div class="reponse" id="reponse-<?php echo $id_carte; ?>" style="display:none;">
                    <font color='green'>Réponse</font><br>
                    <?php
                    echo  $reponse; 
                    ?>
                  </div>
                </br>
            </td>
                   
            <td class='td_tab_btn_affichage' align='center'>
      
              <img class='btn_image' src="./img/valider.png" alt="AValider" onclick="validerCarte(<?php echo $id_carte; ?>)" style="cursor: pointer;">
              <br>
              <img class='btn_image' src="./img/suite.png" alt="Afficher la réponse" onclick="afficheReponse(<?php echo $id_carte; ?>)" style="cursor: pointer;">
              <br>
              <form method='POST' action='modifier.php'>
              <input type='hidden' name='nom_niveau' value='<?php echo $nom_niveau ?>'>
                  <input type='hidden' name='nom_classe' value='<?php echo $nom_classe ?>'>
                  <input type='hidden' name='modifier_carte'>
                  <input type='hidden' name='modifier_affichage'>
                  <input type='hidden' name='id_carte' value="<?php echo  $id_carte ?>">
                  <input type='hidden' name='id_data' value="<?php echo  $id_data ?>">
                  <input type="image"  src="./img/modifier.png" class='btn_image' >
              </form>

            <br>
            
            <img class='btn_image' src="./img/supprimer.png" alt="Supprimer carte" onclick="supprimerCarte(<?php echo $id_carte; ?>, <?php echo $id_data; ?>, '<?php echo $nom_classe; ?>')" style="cursor: pointer;">


            </td>
          <?php
        }
        ?></table>
     
        <?php
      }?>
      </tr><?php

  }
  if ($nb_cartes==0) 
  {?>
    <table class='tableau_affichage_cartes'>
    <td>Pas de carte à réactiver pour le moment</td>
  </table >
    <?php
  }
  ?>

</div>
</body>