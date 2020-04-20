<?php
    include("./connexionBase.php");
    $today = date("Y-m-d H:i:s");
    if (isset($_GET['identi']))
    {
        $sql = "SELECT id FROM acheteur WHERE pseudo='".$_GET['identi']."' AND password='".$_GET['mdp']."'";
    }
    else {
        $sql = "SELECT id FROM acheteur WHERE (email='".$_POST['i/e']."' OR pseudo='".$_POST['i/e']."') AND password='".$_POST['mdp']."'";
    }
    $result=mysqli_query($db_handle,$sql);
    while($data = mysqli_fetch_assoc($result)){
        session_start();
        $_SESSION['id']=$data['id'];
        $_SESSION['type']="acheteur";
        $_SESSION['panier']= array(
            'immediat' => array(),
            'offre' => array(),
            'enchere' => array(),
        );
        $_SESSION['historique']= array(
            'immediat' => array(),
            'offre' => array(),
            'enchere' => array(),
        );
        $sql = "SELECT achatId FROM immediat WHERE acheteurId=".$data['id'];
        $result3=mysqli_query($db_handle,$sql);
        while($data3 = mysqli_fetch_assoc($result3)){
            $sql = "SELECT immediat FROM achat WHERE id=".$data3['achatId'];
            $result2=mysqli_query($db_handle,$sql);
            while($data2 = mysqli_fetch_assoc($result2)){
                if (($data2['immediat']==0)&&($data2['offre']==0)){
                    array_push($_SESSION['historique']['immediat'],$data3['achatId']);
                    array_push($_SESSION['historique']['offre'],$data3['achatId']);
                }
                else if ($data2['offre']==0){
                    array_push($_SESSION['panier']['immediat'],$data3['achatId']);
                }
                else{
                    array_push($_SESSION['panier']['offre'],$data3['achatId']);
                }
            }
        }
        $sql = "SELECT enchereId FROM prixmax WHERE acheteurId=".$data['id'];
        $result3=mysqli_query($db_handle,$sql);
        while($data3 = mysqli_fetch_assoc($result3)){
            $sql = "SELECT fin FROM enchere WHERE id=".$data3['enchereId'];
            $result2=mysqli_query($db_handle,$sql);
            while($data2 = mysqli_fetch_assoc($result2)){
                if ($today>$data2['fin']){
                    array_push($_SESSION['historique']['enchere'],$data3['enchereId']);
                }
                else{
                    array_push($_SESSION['panier']['enchere'],$data3['enchereId']);
                }
            }
        }
    }
    if (isset($_GET['identi']))
    {
        $sql = "SELECT id,admin FROM vendeur WHERE pseudo='".$_GET['identi']."' AND password='".$_GET['mdp']."'";
    }
    else {
        $sql = "SELECT id,admin FROM vendeur WHERE (email='".$_POST['i/e']."' OR pseudo='".$_POST['i/e']."') AND password='".$_POST['mdp']."'";
    }
    $result=mysqli_query($db_handle,$sql);
    while($data = mysqli_fetch_assoc($result)){
        session_start();
        $_SESSION['id']=$data['id'];
        if (!$data['admin']){
            $_SESSION['type']="vendeur";
        }
        else {
            $_SESSION['type']="admin";
        }
        $_SESSION['panier']= array(
            'immediat' => array(),
            'offre' => array(),
            'enchere' => array(),
        );
        $_SESSION['historique']= array(
            'immediat' => array(),
            'offre' => array(),
            'enchere' => array(),
        );
        $sql = "SELECT id,immediat,offre FROM achat WHERE vendeurId=".$data['id'];
        $result2=mysqli_query($db_handle,$sql);
        while($data2 = mysqli_fetch_assoc($result2)){
            if (($data2['immediat']==0)&&($data2['offre']==0)){
                array_push($_SESSION['historique']['immediat'],$data2['id']);
            }
            else {
                if ($data2['immediat']==1){
                    array_push($_SESSION['panier']['immediat'],$data2['id']);
                }
                if ($data2['offre']==1){
                    array_push($_SESSION['panier']['offre'],$data2['id']);
                }
            }
        }
        $sql = "SELECT id,fin FROM enchere WHERE vendeurId=".$data['id'];
        $result2=mysqli_query($db_handle,$sql);
        while($data2 = mysqli_fetch_assoc($result2)){
            if ($today>$data2['fin']){
                array_push($_SESSION['historique']['enchere'],$data2['id']);
            }
            else{
                array_push($_SESSION['panier']['enchere'],$data2['id']);
            }
        }
    }
    if (isset($_SESSION['id'])){
        header("Location: ../index.php");
    }
    else {
        header("Location: ../connexion.php?issues");
    }
?>
