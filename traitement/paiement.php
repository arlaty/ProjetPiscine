<?php
    session_start();
    include("connexionBase.php");
    echo $tit = isset($_POST["tit"])? $_POST["tit"]: "";
    $carte = isset($_POST["carte"])? $_POST["carte"]: "";
    $num = isset($_POST["num"])? $_POST["num"]: "";
    $exp = isset($_POST["exp"])? $_POST["exp"]: "";
    $crypt = isset($_POST["crypt"])? $_POST["crypt"]: "";
    $total = $_GET['total'];
    $id_user = $_SESSION['id'];
    $sql="SELECT * FROM `acheteur` WHERE id=".$_SESSION['id'];
    $result = mysqli_query($db_handle, $sql);
    while($data = mysqli_fetch_assoc($result)){
        if (($carte==$data['typeCarte'])&&($num==$data['numero'])&&($exp==$data['expiration'])&&($crypt==$data['codeSecurite'])&&($total<=$data['solde'])&&($total<=$data['plafond'])){
            foreach ($_SESSION['panier']['immediat'] as $key => $value) {
                $sql="DELETE FROM `immediat` WHERE achatId=".$value." AND acheteurId=".$id_user;
                $result2 = mysqli_query($db_handle, $sql);
                array_push($_SESSION['historique']['immediat'],$value);
                unset($_SESSION['panier']['immediat'][$key]);
                $sql="UPDATE `achat` SET `acheteurId`='$id_user',`immediat`=0,`offre`=0 WHERE id=".$value;
                $result3 = mysqli_query($db_handle, $sql);
            }
        }
    }
    header("Location: ../panier.php");
?>
