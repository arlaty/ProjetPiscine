<?php
    session_start();
    include("connexionBase.php");
    $tit = isset($_POST["tit"])? $_POST["tit"]: "";
    $carte = isset($_POST["carte"])? $_POST["carte"]: "";
    $num = isset($_POST["num"])? $_POST["num"]: "";
    $exp = isset($_POST["exp"])? $_POST["exp"]: "";
    $crypt = isset($_POST["crypt"])? $_POST["crypt"]: "";
    $total = $_GET['total'];
    $sql="SELECT * FROM `acheteur` WHERE id=".$_SESSION['id'];
    $result = mysqli_query($db_handle, $sql);
    while($data = mysqli_fetch_assoc($result)){
        if (($tit==$data['prenom']." ".$data['nom'])&&($carte==$data['typeCarte'])&&($num==$data['numero'])&&($exp==$data['expiration'])&&($crypt==$data['codeSecurite'])&&($crypt==$data['codeSecurite'])){
            
        }
    }
    //header("Location: ../profil.php");
?>
