<?php
    session_start();
    include("connexionBase.php");
    $uploaddir = 'C:/wamp/www/ProjetPiscine/images/';
    $identifiant = isset($_POST["identifiant"])? $_POST["identifiant"]: "";
	$email = isset($_POST["email"])? $_POST["email"]: "";
    $mdp1 = isset($_POST["mdp1"])? $_POST["mdp1"]: "";
    $nom = isset($_POST["nom"])? $_POST["nom"]: "";
    $prenom = isset($_POST["prenom"])? $_POST["prenom"]: "";
    if ($_FILES['profil']['size']!=0) {
        $profil="vendeur".$_SESSION['id']."pp.".explode(".",$_FILES['profil']['name'])[1];
        $uploadfile = $uploaddir . $profil;
        move_uploaded_file($_FILES['profil']['tmp_name'], $uploadfile);
    }
    if ($_FILES['fond']['size']!=0) {
        $fond="vendeur".$_SESSION['id']."fe.".explode(".",$_FILES['fond']['name'])[1];
        $uploadfile = $uploaddir . $fond;
        move_uploaded_file($_FILES['fond']['tmp_name'], $uploadfile);
    }
    if ((isset($profil))&&(isset($fond))){
        $sql="UPDATE `vendeur`SET `pseudo`='$identifiant',`email`='$email',`password`='$mdp1',`prenom`='$prenom',`nom`='$nom',`photo`='$profil',`fondPrefere`='$fond' WHERE id=".$_SESSION['id'];
    }
    else if (isset($profil)) {
        $sql="UPDATE `vendeur`SET `pseudo`='$identifiant',`email`='$email',`password`='$mdp1',`prenom`='$prenom',`nom`='$nom',`photo`='$profil' WHERE id=".$_SESSION['id'];
    }
    else {
        $sql="UPDATE `vendeur`SET `pseudo`='$identifiant',`email`='$email',`password`='$mdp1',`prenom`='$prenom',`nom`='$nom',`fondPrefere`='$fond' WHERE id=".$_SESSION['id'];
    }
    $result = mysqli_query($db_handle, $sql);
    header("Location: ../profil.php");
?>
