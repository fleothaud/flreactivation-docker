<?php 
require('config.php');// pour connexion BDD et création table
date_default_timezone_set('Europe/Paris');//pour les fonctions date
session_start(); // initialisation session active jusqu'à deconnexion
$date_actuelle=floor(time()/86400);
if(isset($_POST['destroy'])){$_SESSION = array();}
$couleurs = array(1=>"green","purple","blue","brown","Chocolate","LightSeaGreen","Indigo","red","SlateBlue");
?>
<!DOCTYPE html >
<html lang="fr">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Lien CDN CSS de Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- JavaScript et dépendances (inclut jQuery et Popper.js pour Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="css/flr_css.css">
<script type="text/javascript" src="js/flr_js.js"></script>
<link rel="stylesheet" href="css/tinymce.css">
<script src="tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<script src="js/tynimce_perso.js" referrerpolicy="origin"></script>



<title>FLRéactivation</title>

<!-- Fenêtre modale -->
<div class="modal" id="maModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content d-flex justify-content-center align-items-center">
        <div class="modal-header">
          <h5 class="modal-title">Identification Administrateur</h5>
        </div>
        <br>
        <form  method="POST" action='parametres.php'>
          <input type="text"  placeholder="login" name="login" required ><br>
          <input type="password"  placeholder="mot de passe" name="password" required >
          <br><br>
          <button type="submit" class="btn btn-primary">valider</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <!-- <button type="button" class="btn cancel" onclick="closeForm()">Annuler</button> -->
      </form>
    </div>
</div>


</div>



<body>
<div  class='conteneur' align="center">  <?php
 if(isset($_SESSION['ajout_classes_niv'])){$nom_niveau=$_SESSION['ajout_classes_niv'];}
 if(isset($_SESSION['ajout_affichage_niv']))
 {
     $nom_niveau=$_SESSION['ajout_affichage_niv'];
     $nom_classe=$_SESSION['ajout_affichage_cla'];
     //$_SESSION=array();
     $_SESSION['ajout_affichage_niv']=$nom_niveau;
     $_SESSION['ajout_affichage_cla']=$nom_classe;

 }

 
    /******************  MENU Classes************************************** */
if(isset($_POST['selection_niveau_niv1']) or isset($_SESSION['ajout_classes_niv']))
{   
    if(isset($_SESSION['ajout_classes_niv'])){$nom_niveau=$_SESSION['ajout_classes_niv'];}
    if(isset($_POST['selection_niveau_niv1'])){$nom_niveau=$_POST['nom_niveau'];}
    //$_SESSION['ajout_classes_niv']=$nom_niveau;

    
    ?>
    <div class='menu'>

      <form method='POST' action='index.php'>
        <input type='hidden' name='destroy'>
        <input type='image' src="./img/accueil.png" class='img_menu' >
      </form>
      <form method='POST' action='ajouter.php'>
      <input type='hidden' name='ajout_classes'>
        <input type="hidden" name="nom_niveau" value="<?php echo $nom_niveau ?>">
        <input type='image' src="./img/ajouter.png" class='img_menu' >
      </form>
    </div>
    <div class="menu_context" >
    <h1><?php echo $nom_niveau ?></h1>
    </div>
 
    <?php
    $data = [
        'nom_niveau' => $nom_niveau,
        ];
    $sql='SELECT * FROM flr_classes WHERE nom_niveau=:nom_niveau ORDER BY nom_classe ASC';

    $req = $bdd->prepare($sql);
    $req->execute($data);
    $result = $req->fetchAll();

    foreach($result as $item) 
    {   
        $i=rand(1,9);
        $id=$item['id'];
        $nom_classe=$item['nom_classe'];
        ?>
        <div class="div_interface">

            <form method="POST" action="affichage.php">  
                <input type='hidden' name='nom_niveau' value='<?php echo $nom_niveau ?>'>
                <input type='hidden' name='nom_classe' value='<?php echo $nom_classe ?>'>
                <input  type='submit' class='bouton' style='background-color:<?php echo $couleurs[$i] ?>' name='selection_classe_niv2' value='<?php echo $nom_classe ?>'>
            </form>
            <!-- <script> ran_col(); </script>  -->
        </div><?php
    }
}
else 
{


?>
   <!--  /******************  MENU Accueil : Bienvenue ************************************** */!-->
<div class='menu'>
  <form method='POST' action='index.php'>
    <input type='image' src="./img/accueil.png" class='img_menu' >
  </form>
  <div >
    <!-- <input type='image' src="./img/parametres.png" class='img_menu' onclick="openForm()"> -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#maModal"> -->
    <input type='image' src="./img/parametres.png" class='img_menu' data-toggle="modal" data-target="#maModal">

  </div>
</div>
<div class="menu_context" >
<h1>Bienvenue dans FLRéactivation</h1>
</div>
    <?php
    $sql='SELECT * FROM flr_niveaux';
    $req = $bdd->prepare($sql);
    $req->execute();
    $result = $req->fetchAll();

    foreach($result as $item) 
    {   
        $i=rand(1,9);
        $id=$item['id'];
        $nom_niveau=$item['nom_niveau'];
        ?>
        <div class="div_interface">

            <form method="POST">  
                <input type='hidden' name='nom_niveau' value='<?php echo $nom_niveau ?>'>
                <input  type='submit' class='bouton' style='background-color:<?php echo $couleurs[$i] ?>' name='selection_niveau_niv1' value='<?php echo $nom_niveau ?>'>
            </form>
            <!-- <script> ran_col(); </script>  -->
        </div><?php
    }
}
        ?>
    </div>
</div><!-- fin conteneur-->

</body>