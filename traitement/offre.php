<?php
    session_start();
    include("connexionBase.php");
    $id=$_GET['id'];
    $id_user=$_SESSION['id'];
    $sql="SELECT * FROM `immediat` WHERE achatId=".$id." AND acheteurId=".$id_user;
    $result = mysqli_query($db_handle, $sql);
    if (mysqli_num_rows($result)!=0){
        header("Location: ../objet.php?id=".$_GET['idObjet']);
    }else {
        $sql="INSERT INTO `immediat`(`achatId`, `acheteurId`) 
          VALUES ('$id','$id_user')";
        $result = mysqli_query($db_handle, $sql);
        array_push($_SESSION['panier']['immediat'],$id);
        header("Location: ../panier.php");
    }
    $id=$_GET['id'];
    $id_user=$_SESSION['id'];
    $sql="DELETE FROM `immediat` WHERE achatId=".$id." AND acheteurId=".$id_user;
    $result = mysqli_query($db_handle, $sql);
    foreach ($_SESSION['panier']['immediat'] as $key => $value) {
        if ($value==$id)
        {
            unset($_SESSION['panier']['immediat'][$key]);
        }
    }
    header("Location: ../panier.php");
?>
