<?php 
require('config.php');// pour connexion BDD et création table
date_default_timezone_set('Europe/Paris');//pour les fonctions date
session_start(); // initialisation session active jusqu"à deconnexion
$date_actuelle=floor(time()/86400);

$couleurs = array(1=>"green","purple","blue","brown","Chocolate","LightSeaGreen","Indigo","red","SlateBlue");
if(isset($_POST['login']))
{   
    
    $login=$_POST['login'];
    $password=$_POST['password'];
    $statut='admin';

    $data = [
    'login' => $login,
    'password' => $password,
    'statut' => $statut,
    ];
    $sql='SELECT * FROM flr_users WHERE login=:login AND password=:password AND statut=:statut' ;
    //$sql='SELECT * FROM mabase WHERE nom=:nom AND prenom=:prenomORDER BY id ASC';
    
    $req = $bdd->prepare($sql);
    $req->execute($data);
    $result = $req->fetchAll();
    $i=0;
    foreach($result as $item)
    {
    $i++;
    }


    if($i>0){
        $_SESSION['login']=$_POST['login'];
        $_SESSION['password']=$_POST['password'];
    
    }
    //else{header('location:index.php');}
}
if(!isset($_SESSION['login'])){header('location:index.php');}
?>
<!DOCTYPE html >
<html lang="fr">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/flr_css.css">
<script type="text/javascript" src="js/flr_js.js"></script>
<link rel="stylesheet" href="css/tinymce.css">
<script src="tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<script src="js/tynimce_perso.js" referrerpolicy="origin"></script>





<title>FLRéactivation</title>
<link rel="stylesheet" href="css/flreactivation.css">

<div class='conteneur_parametres' align='center'>
   <div class='menu' >
   <form method='POST'>
   
   <input type='hidden' name='page_parametres'>
     <input type='image' src="./img/parametres.png" class='img_menu' >
   </form>
   <form method='POST' action='index.php'>
   <input type='hidden' name='destroy'>
     <input type='image' src="./img/accueil.png" class='img_menu' >
   </form>
 </div>
 <?php
 
 if(isset($_POST['page_parametres']))
 {
     unset($_SESSION['modifier_parametres_niv']);
     unset($_SESSION['modifier_parametres_cla']);
 }

if(isset($_SESSION['modifier_parametres_niv']))
{
    $nom_niveau=$_SESSION['modifier_parametres_niv'];
    $nom_classe=$_SESSION['modifier_parametres_cla'];
    //$_SESSION=array();
    unset($_SESSION['modifier_affichage_niv']);
    unset($_SESSION['modifier_affichage_cla']);
    $_SESSION['modifier_parametres_niv']=$nom_niveau;
    $_SESSION['modifier_parametres_cla']=$nom_classe;

}






// if(isset($_SESSION['ajout_classes_niv'])){echo 'ajout_classe_niv: '.$_SESSION['ajout_classes_niv'].'<br>';}else{echo 'ajout_classe_niv:non défini'.'<br>';}
// if(isset($_SESSION['ajout_affichage_niv'])){echo 'ajout_affichage_niv: '.$_SESSION['ajout_affichage_niv'].'<br>';}else{echo 'ajout_affichage_niv:non défini'.'<br>';}
// if(isset($_SESSION['ajout_affichage_cla'])){echo 'ajout_affichage_cla: '.$_SESSION['ajout_affichage_cla'].'<br>';}else{echo 'ajout_affichage_cla:non défini'.'<br>';}
// if(isset($_SESSION['modifier_affichage_niv'])){echo 'modifier_affichage_niv: '.$_SESSION['modifier_affichage_niv'].'<br>';}else{echo 'modifier_affichage_niv:non défini'.'<br>';}
// if(isset($_SESSION['modifier_affichage_cla'])){echo 'modifier_affichage_cla: '.$_SESSION['modifier_affichage_cla'].'<br>';}else{echo 'modifier_affichage_cla:non défini'.'<br>';}
// if(isset($_SESSION['modifier_parametres_niv'])){echo 'modifier_parametres_niv: '.$_SESSION['modifier_parametres_niv'].'<br>';}else{echo 'modifier_parametres_niv:non défini'.'<br>';}
// if(isset($_SESSION['modifier_parametres_cla'])){echo 'modifier_parametres_cla: '.$_SESSION['modifier_parametres_cla'].'<br>';}else{echo 'modifier_parametres_cla:non défini'.'<br>';}


/************************Action au différents POST*******************/

//ajouter un Niveau Niv2
if(isset($_POST['ajouter_niveau_niv2']))
{
    $nom_niveau=$_POST['ajouter_niveau_niv2'];
    $data = [
            'nom_niveau' => $nom_niveau,
            ];
    $req = $bdd->prepare('INSERT INTO flr_niveaux (nom_niveau) VALUES (:nom_niveau)');
    $req->execute($data);
}


 //Supprimer un niveau niv2
if(isset($_POST['supprimer_niveau_niv2']))
{
    $id=$_POST['supprimer_niveau_niv2'];
    $data = [
            'id' => $id,
            ];
    $sql = 'DELETE FROM flr_niveaux WHERE id = :id';
    $req= $bdd->prepare($sql);
    $req->execute($data);
}


//ajouter une discipline Niv2
if(isset($_POST['ajouter_discipline_niv2']))
{
    $nom_discipline=$_POST['ajouter_nom_discipline_text_niv2'];
    $data = [
            'nom_discipline' => $nom_discipline,
            ];
        $req = $bdd->prepare('INSERT INTO flr_disciplines (nom_discipline) VALUES (:nom_discipline)');
        $req->execute($data);
}


 //Supprimer une disciplinenie
if(isset($_POST['supprimer_discipline_niv2']))
{
    $id=$_POST['supprimer_discipline_niv2'];
    $data = [
            'id' => $id,
            ];
    $sql = 'DELETE FROM flr_disciplines WHERE id = :id';
    $req= $bdd->prepare($sql);
    $req->execute($data);
}




//Ajouter une classe niv2
if(isset($_POST['ajouter_classe_niv2']))
{
    $nom_niveau=$_POST['choix_niveau_niv2'];
    $nom_classe=$_POST['nom_classe'];
    $data = [
            'nom_niveau' => $nom_niveau,
            'nom_classe' => $nom_classe,
            ];
    $req = $bdd->prepare('INSERT INTO flr_classes (nom_niveau,nom_classe) VALUES (:nom_niveau,:nom_classe)');
    $req->execute($data);
}

//Supprimer une classe niv2
if(isset($_POST['supprimer_classe_niv2']))
{
    $id=$_POST['supprimer_classe_niv2'];
    $data = [
                'id' => $id,
            ];
    $sql = 'DELETE FROM flr_classes WHERE id = :id';
    $req= $bdd->prepare($sql);
    $req->execute($data);
}
 

//Ajouter une data niv2
if(isset($_POST['ajouter_data_niv2']))
{
    $question=$_POST['ajouter_question_text_niv2'];
    $reponse=$_POST['ajouter_reponse_text_niv2'];
    $nom_discipline=$_POST['choix_discipline_data_niv2'];
    $data = [
            'question' => $question,
            'reponse' => $reponse,
            'nom_discipline' => $nom_discipline,
            ];
        $req = $bdd->prepare('INSERT INTO flr_data (question,reponse,nom_discipline) VALUES (:question,:reponse,:nom_discipline)');
        $req->execute($data);

}

//Supprimer data niv2
if(isset($_POST['supprimer_data_niv2']))
{
    $id_data=$_POST['id_data'];
    $data = [
        'id_data' => $id_data,
    ];
    $sql='SELECT * FROM flr_cartes WHERE id_data=:id_data';
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
    $sql = 'DELETE FROM flr_data WHERE id = :id_data';
    $req= $bdd->prepare($sql);
    $req->execute($data);
    $sql = 'DELETE FROM flr_cartes WHERE id_data = :id_data';
    $req= $bdd->prepare($sql);
    $req->execute($data);
}

//Ajouter une carte niv2
if(isset($_POST['ajouter_cartes_niv2']))
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
                ];
        $req = $bdd->prepare('INSERT INTO flr_data (question,reponse,nom_discipline) VALUES (:question,:reponse,:nom_discipline)');
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
    else
    {
        echo 'erreur';
    }

}

//Supprimer carte niv2
if(isset($_POST['supprimer_cartes_niv2']))
{
    $id=$_POST['supprimer_cartes_niv2'];
    $data = [
                'id' => $id,
            ];
    $sql = 'DELETE FROM flr_cartes WHERE id = :id';
    $req= $bdd->prepare($sql);
    $req->execute($data);
}


//Ajouter une parametre_reactivation niv2
if(isset($_POST['ajouter_parametre_reactivation_niv2']))
{
    $num_reac=$_POST['ajouter_parametre_reactivation_text_num_niv2'];
    $duree_reac=$_POST['ajouter_parametre_reactivation_text_duree_niv2'];
    $data = [
            'num_reac' => $num_reac,
            'duree_reac' => $duree_reac,
            ];
        $req = $bdd->prepare('INSERT INTO flr_parametres_reactivations (num_reac,duree_reac) VALUES (:num_reac,:duree_reac)');
        $req->execute($data);

}

//Supprimer data niv2
if(isset($_POST['supprimer_parametre_reactivation_niv2']))
{
    $id=$_POST['supprimer_parametre_reactivation_niv2'];
    $data = [
                'id' => $id,
            ];
    $sql = 'DELETE FROM flr_parametres_reactivations WHERE id = :id';
    $req= $bdd->prepare($sql);
    $req->execute($data);
}?>
<?php
 

//Aller Page Gerer Niveau niv2
if(isset($_POST['gerer_niveau_niv1'])or isset($_POST['ajouter_niveau_niv2']) or isset($_POST['supprimer_niveau_niv2']))
{?> 
    <div class="menu_context">
        <h1>Gestion Niveaux</h1>
    </div><?php
    $sql='SELECT * FROM flr_niveaux';
    //$sql='SELECT * FROM mabase WHERE niveau=:niveau AND prenom=:prenomORDER BY id ASC';
    $req = $bdd->prepare($sql);
    $req->execute();
    $result = $req->fetchAll();?>
    <table class='tableau_constantes_parametres'><?php 
        foreach($result as $item)
        {
            $nom_niveau=$item['nom_niveau'];
            $id_niveau=$item['id']
             ?>
            <tr>
                <td>
                    <?php echo  $nom_niveau ?>
                </td>
                <td>
                    <form method='POST'>
                        <input type='hidden' name='supprimer_niveau_niv2' value="<?php echo $id_niveau ?>">
                        <input type="image" src="./img/supprimer.png" class='btn_image' onclick="return confirm('Confirmer la suppression ?')">
	                </form>
                </td>
            </tr>
            <?php
        }?>
    </table>
    <form method='POST'>
        <input type='text' class='input_text_parametres' name='ajouter_niveau_niv2' placeholder="saisir le nom du niveau" required>
        <br>
        <input type='submit' class='btn_parametres' name='bouton_ajouter_niveau_niv2' value='ajouter niveau'>
    </form><?php
}


//Aller Page gerer classes niv2
elseif (isset($_POST['gerer_classes_niv1']) or isset($_POST['ajouter_classe_niv2']) or isset($_POST['supprimer_classe_niv2']))
{?> 
    <div class="menu_context">
        <h1>Gestion classes</h1>
    </div><?php
    $sql='SELECT * FROM flr_classes ORDER BY nom_classe';
        //$sql='SELECT * FROM mabase WHERE niveau=:niveau AND prenom=:prenomORDER BY id ASC';
        $req = $bdd->prepare($sql);
        $req->execute();
        $result = $req->fetchAll();?>
        <table class='tableau_constantes_parametres'><?php 
            foreach($result as $item)
            {
                $nom_classe=$item['nom_classe'];
                $nom_niveau=$item['nom_niveau']; 
                $id_classe=$item['id']?>
                <tr>
                    <td>
                        Niveau: <?php echo  $nom_niveau ?>
                        <br>
                        Nom: <?php echo  $nom_classe ?>
                    </td>
                    <td>
                        <form method='POST'>
	                        <input type='hidden' name='supprimer_classe_niv2' value="<?php echo $id_classe ?>">
	                        <input type="image" src="./img/supprimer.png" class='btn_image' onclick="return confirm('Confirmer la suppression ?')">
	                    </form>
                    </td>
                </tr>
                <?php
            }?>
        </table>
        <form method='POST'>
            <select name='choix_niveau_niv2'>
                <libellé>Selectionner le niveau</libellé>
                <?php
                $sql='SELECT * FROM flr_niveaux ORDER BY nom_niveau DESC';
                $req = $bdd->prepare($sql);
                $req->execute();
                $result = $req->fetchAll();
                
                     foreach($result as $item)
                    {
                        $nom_niveau=$item['nom_niveau'];?>
                        <option name='choix_niveau[]' valeur='<?php echo $nom_niveau ?>'><?php echo $nom_niveau ?></option>
                    <?php
                    }?>  
               
            </select>
            <input type='text' class='input_text_parametres' name='nom_classe' style="width:25%" placeholder="Sélectionner le niveau et saisir le nom de la classe" required></input>
            <br>
            <input type='submit' class='btn_parametres' name='ajouter_classe_niv2' value='ajouter classe'></input>
        </form>
        
        <?php
}

//Aller Page gerer disciplines niv2
elseif (isset($_POST['gerer_disciplines_niv1']) or isset($_POST['ajouter_discipline_niv2']) or isset($_POST['supprimer_discipline_niv2']))
{?> 
    <div class="menu_context">
        <h1>Gestion disciplines</h1>
    </div><?php
    $sql='SELECT * FROM flr_disciplines ORDER BY nom_discipline';
        //$sql='SELECT * FROM mabase WHERE niveau=:niveau AND prenom=:prenomORDER BY id ASC';
        $req = $bdd->prepare($sql);
        $req->execute();
        $result = $req->fetchAll();?>
        <table class='tableau_constantes_parametres'><?php 
            foreach($result as $item)
            {
                $nom_discipline=$item['nom_discipline'];
                $id_discipline=$item['id']?>
                <tr>
                    <td>
                        <?php echo  $nom_discipline ?>
                    </td>
                    <td>
                        <form method='POST'>
	                        <input type='hidden' name='supprimer_discipline_niv2' value="<?php echo $id_discipline ?>">
	                        <input type="image" src="./img/supprimer.png" class='btn_image' onclick="return confirm('Confirmer la suppression ?')">
	                    </form>
                    </td>
                </tr>
                <?php
            }?>
        </table>
        <form method='POST'>
            <input type='text' class='input_text_parametres' name='ajouter_nom_discipline_text_niv2' placeholder="saisir le nom de la discipline" required></input>
            <br>
            <input type='submit' class='btn_parametres' name='ajouter_discipline_niv2' value='ajouter discipline'></input>
        </form>
        
        <?php
}


//Aller Page Gerer data niv2
elseif(isset($_POST['gerer_data_niv1']) 
or isset($_POST['ajouter_data_niv2']) 
or isset($_POST['supprimer_data_niv2'])
or isset($_POST['trier'])
or isset($_SESSION['modifier_parametres_niv'])
)
{?> 
    <div class="menu_context">
        <h1>Synthèse cartes</h1>
    </div><?php

    if(isset($_POST['trier'])){$tri=$_POST['trier'];}
    else{$tri='id ASC';}
        $sql='SELECT * FROM flr_data ORDER BY '.$tri;
        //$sql='SELECT * FROM flr_data ORDER BY id DESC';
        //$sql='SELECT * FROM mabase WHERE niveau=:niveau AND prenom=:prenomORDER BY id ASC';
        $req = $bdd->prepare($sql);
        $req->execute();
        $result = $req->fetchAll();?>

    <table class='tableau_parametres_data'>
        <th width='5%'>

                <div style="float:left">
                    <form method='POST'>
                        <input type='hidden' name='trier' value="id ASC">
                        <input type="image" src="./img/triASC.png" width="20px">
                    </form>
                </div>
                <div style="float:left">
                    <form method='POST'>
                        <input type='hidden' name='trier' value="id DESC">
                        <input type="image" src="./img/triDESC.png" width="20px"  >
                    </form>
                </div>
        </th>
        <th width='42%'>Question</th>
        <th width='42%'>Réponses</th>
        
        <th width='5%'>
        <div style="display:flex;width:100%;justify-content: center;">
            <div style="float:left">
                <form method='POST'>
                        <input type='hidden' name='trier' value="nom_niveau ASC">
                        <input type="image" src="./img/triASC.png" width="20px">
                    </form>
            </div>
            <div style="float:left">
                <form method='POST'>
                    <input type='hidden' name='trier' value="nom_niveau DESC">
                    <input type="image" src="./img/triDESC.png" width="20px"  >
                </form>
            </div> 
        </div>   
    </th>
        <th width='5%'><font size='-1'>
        <div style="display:flex;width:100%;justify-content: center;">
            <div style="float:left;">
                <form method='POST'>
                    <input type='hidden' name='trier' value="nom_discipline ASC">
                    <input type="image" src="./img/triASC.png" width="20px">
                </form>
            </div>
            <div style="float:left;">
                <form method='POST'>
                    <input type='hidden' name='trier' value="nom_discipline DESC">
                    <input type="image" src="./img/triDESC.png" width="20px"  >
                </form>
            </div>      
        </div>
                        </th>

        <th width='5%'><font size='-1'>Modif.</font></th>
        <th width='5%'><font size='-1'>Supr.</font></th>

            <?php 
            foreach($result as $item)
            {?>   <?php
                $question=$item['question'];
                $reponse=$item['reponse'];
                $nom_discipline=$item['nom_discipline'];
                $id_data=$item['id'];
                $nom_niveau=$item['nom_niveau'];
                ?>
                <tr>
                <td><?php echo  $id_data;?></td>
                <td class='td_tab_input_parametres'>
                    <div class='div_scroll_data_parametre'>
                        <?php echo  $question;?>
                    </div>
                </td>
                <td class='td_tab_input_parametres'>
                <div class='div_scroll_data_parametre'>
                    <?php echo  $reponse;?>
                    </div>
                </td>
        
                <td>
                    <font size='-1'><?php
                    $data = [
                    'id_data' => $id_data,
                    ];
                    $sql='SELECT * FROM flr_cartes WHERE id_data=:id_data';
                    $req = $bdd->prepare($sql);
                    $req->execute($data);
                    $result = $req->fetchAll();
                    foreach($result as $item)
                    {
                    $nom_classe=$item['nom_classe'];
                    echo $nom_classe;
                    echo '</br>';
                    }

                    ?>                
                    </font>
                </td>
                
                <td><?php echo  $nom_discipline;?></td>
                

                <td align="center">
                    <form method='POST' action="modifier.php">
                        <input type='hidden' name='nom_niveau' value='<?php echo $nom_niveau ?>'>
                        <input type='hidden' name='nom_classe' value='<?php echo $nom_classe ?>'>
                        <input type='hidden' name='modifier_parametres'>
                        <input type='hidden' name='modifier_carte'>
                        <input type='hidden' name='id_data' value="<?php echo  $id_data ?>">
                        <input type="image" src="./img/modifier.png" class='btn_image' >
                            </form>
                </td>
            
                
                <td align="center">
                    <form method='POST'>
                                <input type='hidden' name='id_data' value='<?php echo $id_data ?>'>
                                <input type='hidden' name='supprimer_data_niv2' value="<?php echo $id_data ?>">
                                <input type="image" src="./img/supprimer.png" class='btn_image' onclick="return confirm('Confirmer la suppression ?')">
                            </form>
                </td>
        
            </tr>
            
                <?php
            }?>
    </table><?php
   
      
}

//Aller Page Gerer parametres reactivations niv2
elseif(isset($_POST['gerer_parametres_reactivations_niv1'])or isset($_POST['ajouter_parametre_reactivation_niv2']) or isset($_POST['supprimer_parametre_reactivation_niv2']))
{?> 
    <div class="menu_context">
        <h1>Gestion paramètres de réactivation</h1>
    </div><?php
    $sql='SELECT * FROM flr_parametres_reactivations';
    //$sql='SELECT * FROM mabase WHERE niveau=:niveau AND prenom=:prenomORDER BY id ASC';
    $req = $bdd->prepare($sql);
    $req->execute();
    $result = $req->fetchAll();?>
    <table class='tableau_constantes_parametres' style="width:50%"><?php 
        foreach($result as $item)
        {
            $num_reac=$item['num_reac'];
            $duree_reac=$item['duree_reac'];
            $id_parametre_reac=$item['id'];
             ?>
            <tr>
                <td>
                    Réactivation n°: <?php echo  $num_reac ?>
                </td>
                <td>
                    Réactivation suivante <?php echo  $duree_reac ?> jours après.
                </td>
                <td>
                    <form method='POST'>
                        <input type='hidden' name='supprimer_parametre_reactivation_niv2' value="<?php echo $id_parametre_reac ?>">
                        <input type="image" src="./img/supprimer.png" class='btn_image' onclick="return confirm('Confirmer la suppression ?')">
	                </form>
                </td>
            </tr>
            <?php
        }?>
    </table>
    <form method='POST'>
        <input type='number' name='ajouter_parametre_reactivation_text_num_niv2' placeholder="saisir le numéro de la réactivation à ajouter" style="width:50%" required></br>
        <input type='number' name='ajouter_parametre_reactivation_text_duree_niv2' placeholder="saisir le nombre de jours avant la réactivation suivante" style="width:50%" required></br>
        <input type='submit' class='btn_parametres' name='ajouter_parametre_reactivation_niv2' value='ajouter niveau' style="width:50%">
    </form><?php
}



/*********** Page accueil niv1****************************/
else {?> 
    <div class="menu_context">
        <h1>Paramètres</h1>
    </div>

    <div class="div_interface_parametres" style='width:100%'>
    <?php $i=rand(1,9);?>
        <form method='POST'>
            <input type='submit' class='bouton' name='gerer_data_niv1' value='Gerer les cartes de réactivation' style='background-color:<?php echo $couleurs[$i] ?>'>
        </form>
    </div>

    <div class="div_interface_parametres">
        <?php $i=rand(1,9);?>
        <form method='POST'>
            <input type='submit' class='bouton' name='gerer_niveau_niv1' value='Gerer les Niveaux' style='background-color:<?php echo $couleurs[$i] ?>'>
        </form>
    </div>
   
    <div class="div_interface_parametres">
    <?php $i=rand(1,9);?>
        <form method='POST'>
            <input type='submit' class='bouton' name='gerer_classes_niv1' value='Gerer les Classes' style='background-color:<?php echo $couleurs[$i] ?>'>
        </form>
    </div>

    <div class="div_interface_parametres">
        
    <?php $i=rand(1,9);?>
        <form method='POST'>
            <input type='submit' class='bouton' name='gerer_disciplines_niv1' value='Gerer les Disciplines'  style='background-color:<?php echo $couleurs[$i] ?>'>
        </form>
    </div>

    <div class="div_interface_parametres">
    <?php $i=rand(1,9);?>
        <form method='POST'>
        <?php $texte_bouton="Gerer le paramètres\n\n de réactivation"; ?> 
            <input type='submit' class='bouton' name='gerer_parametres_reactivations_niv1' value='<?php echo $texte_bouton?>' style='background-color:<?php echo $couleurs[$i] ?>' >
        </form>
    </div>
    <script> ran_col(); </script> 
</div><?php 
}?>
</div>



