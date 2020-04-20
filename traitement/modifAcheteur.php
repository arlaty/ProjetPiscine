<?php
    session_start();
    include("connexionBase.php");
    $identifiant = isset($_POST["identifiant"])? $_POST["identifiant"]: "";
	$email = isset($_POST["email"])? $_POST["email"]: "";
    $mdp1 = isset($_POST["mdp1"])? $_POST["mdp1"]: "";
    $nom = isset($_POST["nom"])? $_POST["nom"]: "";
    $prenom = isset($_POST["prenom"])? $_POST["prenom"]: "";
    $ad1 = isset($_POST["ad1"])? $_POST["ad1"]: "";
    $ad2 = isset($_POST["ad2"])? $_POST["ad2"]: "";
    $ville = isset($_POST["ville"])? $_POST["ville"]: "";
    $CP = isset($_POST["CP"])? $_POST["CP"]: "";
    $pays = isset($_POST["pays"])? $_POST["pays"]: "";
    $tel = isset($_POST["tel"])? $_POST["tel"]: "";
    $carte = isset($_POST["carte"])? $_POST["carte"]: "";
    $num = isset($_POST["num"])? $_POST["num"]: "";
    $exp = isset($_POST["exp"])? $_POST["exp"]: "";
    $crypt = isset($_POST["crypt"])? $_POST["crypt"]: "";
    $sql="UPDATE `acheteur` SET `pseudo`='$identifiant',`email`='$email',`password`='$mdp1',`prenom`='$prenom',`nom`='$nom',`typeCarte`='$carte',`numero`='$num',`expiration`='$exp',
    `codeSecurite`='$crypt',`adresse1`='$ad1',`adresse2`='$ad2',`ville`='$ville',`cp`='$CP',`pays`='$pays',`tel`='$tel' WHERE id=".$_SESSION['id'];
    $result = mysqli_query($db_handle, $sql);
    header("Location: ../profil.php");
?>
