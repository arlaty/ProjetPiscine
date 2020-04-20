<?php
    session_start();
    include("connexionBase.php");
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
