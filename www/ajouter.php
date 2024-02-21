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
<div class='conteneur' align="center">
    

<?php
if(isset($_POST['ajout_classes']))
{
  //$_SESSION=array();
  $_SESSION['ajout_classes_niv']=$_POST['nom_niveau'];
 }

if(isset($_POST['ajout_affichage']))
{
    unset($_SESSION['ajout_classe_niv']);
    unset($_SESSION['modifier_affichage_niv']);
    unset($_SESSION['modifier_affichage_cla']);
  //$_SESSION=array();
  $_SESSION['ajout_affichage_niv']=$_POST['nom_niveau'];
  $_SESSION['ajout_affichage_cla']=$_POST['nom_classe'];

}
if(isset($_POST['nom_niveau'])){$nom_niveau=$_POST['nom_niveau'];}
if(isset($_POST['nom_classe'])){$nom_classe=$_POST['nom_classe'];}


?>
<!---- Menu ---->
<div class='menu'>

    <form method='POST' action='index.php'>
    <input type='hidden' name='destroy'>
    <input type='image' src="./img/accueil.png" class='img_menu' >
    </form>
    </div>
<div class="menu_context">
<h1><?php echo $nom_niveau ?></h1>
</div>
<?php
    // Quand clique sur ajouter carte
    if(isset($_POST['ajouter_carte']))
    {
               
        if(isset($_POST['choix_classes']))
        {
            $question=$_POST['ajouter_cartes_question_text_niv2'];
            $reponse=$_POST['ajouter_cartes_reponse_text_niv2'];
            $nom_discipline=$_POST['choix_discipline_data_niv2'];
            $choix_classes=$_POST['choix_classes'];
            //enregistrement question, reponse nom_discipline ds data
            $data = [
                    'question' => $question,
                    'reponse' => $reponse,
                    'nom_discipline' => $nom_discipline,
                    'nom_niveau' => $nom_niveau,
                    ];
            $req = $bdd->prepare('INSERT INTO flr_data (question,reponse,nom_discipline,nom_niveau) VALUES (:question,:reponse,:nom_discipline,:nom_niveau)');
            $req->execute($data);
            // on recupere l'id de la nouvelle entréé ds data

            $sql='SELECT * FROM flr_data ORDER BY id ASC';
            $req = $bdd->prepare($sql);
            $req->execute();
            $result = $req->fetchAll();
            foreach($result as $item)
            {
                $id_data=$item['id'];
            }   
            //insertion infos ds cartes
            foreach($choix_classes as $nom_classe)
            {
                $data = [
                        'nom_classe' => $nom_classe,
                        'id_data' => $id_data,
                        'mise_en_ligne'=> $date_actuelle,
                        ];
                $req = $bdd->prepare('INSERT INTO flr_cartes (nom_classe,id_data,mise_en_ligne) VALUES (:nom_classe,:id_data,:mise_en_ligne)');
                $req->execute($data);
            }
        }
if(isset($_SESSION['ajout_affichage_niv'])){header('location:affichage.php');}        
if(isset($_SESSION['ajout_classes_niv'])){header('location:index.php');}

    }?>

<!---- Interface saisie carte ---->
<div align="left">
    <form method='POST'>
        <fieldset>
            <legend>Question</legend>
            <textarea id="file-picker" name='ajouter_cartes_question_text_niv2'></textarea><br>
        </fieldset>
        <fieldset>
            <legend>Réponse</legend>
            <textarea id="file-picker"  name='ajouter_cartes_reponse_text_niv2'></textarea></br>
        </fieldset>
        <fieldset>
            <legend>Discipline</legend>
            <select name='choix_discipline_data_niv2'><?php
                $sql='SELECT * FROM flr_disciplines ORDER BY nom_discipline ASC';
                $req = $bdd->prepare($sql);
                $req->execute();
                $result = $req->fetchAll();
                foreach($result as $item)
                {
                    $nom_discipline=$item['nom_discipline'];?>
                    <option name='choix_discipline[]' valeur='<?php echo $nom_discipline ?>'><?php echo $nom_discipline ?></option><?php
                }?>  
            </select></br>
        </fieldset>
        <fieldset>
            <legend>Classe(s)</legend><?php
            $data=['nom_niveau' => $nom_niveau,];
            $sql='SELECT * FROM flr_classes WHERE nom_niveau=:nom_niveau';
            $req = $bdd->prepare($sql);
            $req->execute($data);
            $result = $req->fetchAll();
            foreach($result as $item)
            {
                $nom_classe_temp=$item['nom_classe'];?>
                <input type='checkbox' name='choix_classes[]' value='<?php echo $nom_classe_temp ?>'<?php 
                if (isset($_POST['nom_classe']))
                {
                    if($nom_classe==$nom_classe_temp){echo "checked";}
                }
                ?>><?php echo $nom_classe_temp ?></br><?php
            }?> 
        </fieldset>


        <input type='hidden' name='nom_niveau' value='<?php echo $nom_niveau ?>'>
        <?php
        if(isset($nom_classe))
        {?>
            <input type='hidden' name='nom_classe' value='<?php echo $nom_classe ?>'><?php
        }?>
        <input type='submit' name='ajouter_carte' value='ajouter cartes'>
    </form>
        </div>
</div>

