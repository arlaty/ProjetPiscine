<?php
    session_start();
    include("connexionBase.php");
    $id=$_GET['id'];
    $id_user=$_SESSION['id'];
    if (isset($_POST['prixAcheteur'])){
        $sql="SELECT * FROM `offre` WHERE achatId=".$id." AND acheteurId=".$id_user;
        $result = mysqli_query($db_handle, $sql);
        if (mysqli_num_rows($result)!=0){
            while($data = mysqli_fetch_assoc($result)) {
                $nbNegoc=$data['nbNegoc']+1;
                $prix=$_POST['prixAcheteur'];
                $sql= "UPDATE `offre` SET `prixAcheteur`='$prix',`nbNegoc`='$nbNegoc' WHERE achatId=".$id." AND acheteurId=".$id_user;
            }
            $result = mysqli_query($db_handle, $sql);
        }else {
            $prix=$_POST['prixAcheteur'];
            $prix2=$_GET['prix'];
            $sql="INSERT INTO `offre`(`acheteurId`, `achatId`, `prixAcheteur`, `prixVendeur`, `nbNegoc`) 
            VALUES ($id_user,$id,$prix,$prix2,1)";
            $result = mysqli_query($db_handle, $sql);
            array_push($_SESSION['panier']['offre'],$id);
        }
        header("Location: ../panier.php");
    }
    if (isset($_POST['prixVendeur'])){
        $id_user=$_GET['acheteur'];
        $sql="SELECT * FROM `offre` WHERE achatId=".$id." AND acheteurId=".$id_user;
        $result = mysqli_query($db_handle, $sql);
        while($data = mysqli_fetch_assoc($result)) {
            $nbNegoc=$data['nbNegoc']+1;
            $prix=$_POST['prixVendeur'];
            $sql= "UPDATE `offre` SET `prixVendeur`='$prix',`nbNegoc`='$nbNegoc' WHERE achatId=".$id." AND acheteurId=".$id_user;
        }
        $result = mysqli_query($db_handle, $sql);
        header("Location: ../objet.php?id=".$_GET['objetId']);
    }
    if (isset($_POST['prixMax'])){
        header("Location: ../panier.php");
        $prix=$_POST['prixMax'];
        $sql="INSERT INTO `prixmax`(`enchereId`, `acheteurId`, `prixMax`) VALUES ('$id','$id_user','$prix')";
        array_push($_SESSION['panier']['enchere'],$id);
        $result = mysqli_query($db_handle, $sql);
    }
?>
