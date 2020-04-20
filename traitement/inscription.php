<?php
    session_start();
    include("connexionBase.php");
    $identifiant = isset($_POST["identifiant"])? $_POST["identifiant"]: "";
	$email = isset($_POST["email"])? $_POST["email"]: "";
	$mdp1 = isset($_POST["mdp1"])? $_POST["mdp1"]: "";
    $sql = "SELECT id FROM acheteur WHERE email='".$email."' OR pseudo='".$identifiant."'";
    $result=mysqli_query($db_handle,$sql);
    if (mysqli_num_rows($result)!=0){
        if(isset($_SESSION['id'])){
            header("Location: ../profil.php?issues");
        }
        else {
            header("Location: ../connexion.php?issues");
        }
    }else {
        $sql = "SELECT id FROM vendeur WHERE email='".$email."' OR pseudo='".$identifiant."'";
        $result=mysqli_query($db_handle,$sql);
        if (mysqli_num_rows($result)!=0){
            if(isset($_SESSION['id'])){
                header("Location: ../profil.php?issues");
            }
            else {
                header("Location: ../connexion.php?issues");
            }
        }
        else {
            $nom = isset($_POST["nom"])? $_POST["nom"]: "";
            $prenom = isset($_POST["prenom"])? $_POST["prenom"]: "";
            if ($_POST['type']=="acheteur"){
                $carte = isset($_POST["carte"])? $_POST["carte"]: "";
                $num = isset($_POST["num"])? $_POST["num"]: "";
                $exp = isset($_POST["exp"])? $_POST["exp"]: "";
                $crypt = isset($_POST["crypt"])? $_POST["crypt"]: "";
                $ad1 = isset($_POST["ad1"])? $_POST["ad1"]: "";
                $ad2 = isset($_POST["ad2"])? $_POST["ad2"]: "";
                $ville = isset($_POST["ville"])? $_POST["ville"]: "";
                $CP = isset($_POST["CP"])? $_POST["CP"]: "";
                $pays = isset($_POST["pays"])? $_POST["pays"]: "";
                $tel = isset($_POST["tel"])? $_POST["tel"]: "";
                $sql= "INSERT INTO `acheteur`(`pseudo`, `email`, `password`, `nom`, `prenom`, `typeCarte`, `numero`, `expiration`, `codeSecurite`, `solde`, `plafond`, `adresse1`, `adresse2`, `ville`, `cp`, `pays`, `tel`) 
                VALUES ('$identifiant','$email','$mdp1','$prenom','$nom','$carte','$num','$exp','$crypt',100000,10000,'$ad1','$ad2','$ville','$CP','$pays','$tel')";
                $result = mysqli_query($db_handle, $sql);
            }
            else {
                $sql="INSERT INTO `vendeur`(`admin`, `pseudo`, `email`, `password`, `prenom`, `nom`, `photo`, `fondPrefere`) 
                VALUES (0,'$identifiant','$email','$mdp1','$prenom','$nom',null,null)";
                $result = mysqli_query($db_handle, $sql);
            }
            if(isset($_SESSION['id'])){
                header("Location: ../profil.php");
            }
            else {
                header("Location: connexion.php?identi=".$identifiant."&mdp=".$mdp1);
            }
        }
    }
?>
