<?php
    session_start();
    include("connexionBase.php");
    $uploaddir = 'images/';
    $uploadfile = $uploaddir . basename($_FILES['profil']['name']);
    if (!isset($_FILES['profil']))echo '<pre>';
    if (move_uploaded_file($_FILES['profil']['tmp_name'], $uploadfile)) {
        echo "Le fichier est valide, et a été téléchargé
            avec succès. Voici plus d'informations :\n";
    } else {
        echo "Attaque potentielle par téléchargement de fichiers.
            Voici plus d'informations :\n";
    }

    echo 'Voici quelques informations de débogage :';
    print_r($_FILES);

    echo '</pre>';
    $identifiant = isset($_POST["identifiant"])? $_POST["identifiant"]: "";
	$email = isset($_POST["email"])? $_POST["email"]: "";
	$mdp1 = isset($_POST["mdp1"])? $_POST["mdp1"]: "";
    $prenom = isset($_POST["prenom"])? $_POST["prenom"]: "";
    $sql="INSERT INTO `vendeur`(`admin`, `pseudo`, `email`, `password`, `prenom`, `nom`, `photo`, `fondPrefere`) 
    VALUES (0,'$identifiant','$email','$mdp1','$nom','$prenom',null,null)";
    $result = mysqli_query($db_handle, $sql);
    //header("Location: ../profil.php");
?>
