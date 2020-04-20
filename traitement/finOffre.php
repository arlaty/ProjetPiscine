<?php
    session_start();
    include("connexionBase.php");
    $id=$_GET['achatId'];
    $id_user=$_GET['acheteurId'];
    if (isset ($_GET['suppr'])){
        $sql="DELETE FROM `offre` WHERE achatId=".$id." AND acheteurId=".$id_user;
        $result = mysqli_query($db_handle, $sql);
        array_push($_SESSION['historique']['offre'],$id);
        foreach ($_SESSION['panier']['offre'] as $key => $value) {
            if ($value==$id)
            {
                unset($_SESSION['panier']['offre'][$key]);
            }
        }
    }
    if (isset ($_GET['valider'])){
        $sql="SELECT * FROM `offre` WHERE achatId=".$id." AND acheteurId=".$id_user;
        $result = mysqli_query($db_handle, $sql);
        while($data = mysqli_fetch_assoc($result)) {
            if ($_SESSION['type']=="acheteur"){
                $prix=$data['prixVendeur'];
            }
            else {
                $prix=$data['prixAcheteur'];
            }
            $sql="UPDATE `achat` SET `acheteurId`='$id_user',`prix`=$prix,`immediat`=0,`offre`=0 WHERE id=".$id;
            $result2 = mysqli_query($db_handle, $sql);
        }
    }
    header("Location: ../profil.php");
?>