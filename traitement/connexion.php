<?php
    include("./connexionBase.php");
    $today = date("Y-m-d H:i:s");
    $sql = "SELECT id FROM acheteur WHERE (email='".$_POST['i/e']."' OR pseudo='".$_POST['i/e']."') AND password='".$_POST['mdp']."'";
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
            'achat' => array(),
            'enchere' => array(),
        );
        $sql = "SELECT id,immediat,offre FROM achat WHERE acheteurId=".$data['id'];
        $result2=mysqli_query($db_handle,$sql);
        while($data2 = mysqli_fetch_assoc($result2)){
            if ($data2['immediat']==0){
                array_push($_SESSION['historique']['achat'],$data2['id']);
            }
            else{
                array_push($_SESSION['panier']['immediat'],$data2['id']);
            }
        }
        $sql = "SELECT achatId FROM offre WHERE acheteurId=".$data['id'];
        $result3=mysqli_query($db_handle,$sql);
        while($data3 = mysqli_fetch_assoc($result3)){
            $sql = "SELECT offre FROM achat WHERE id=".$data3['achatId'];
            $result2=mysqli_query($db_handle,$sql);
            while($data2 = mysqli_fetch_assoc($result2)){
                if ($data2['offre']==0){
                    array_push($_SESSION['historique']['achat'],$data3['achatId']);
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
    $sql = "SELECT id,admin FROM vendeur WHERE (email='".$_POST['i/e']."' OR pseudo='".$_POST['i/e']."') AND password='".$_POST['mdp']."'";
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
            'achat' => array(),
            'enchere' => array(),
        );
        $sql = "SELECT id,immediat,offre FROM achat WHERE acheteurId=".$data['id'];
        $result2=mysqli_query($db_handle,$sql);
        while($data2 = mysqli_fetch_assoc($result2)){
            if (($data2['immediat']==0)&&($data2['offre']==0)){
                array_push($_SESSION['historique']['achat'],$data2['id']);
            }
            else if ($data2['immediat']==1){
                array_push($_SESSION['panier']['immediat'],$data2['id']);
            }
            else{
                array_push($_SESSION['panier']['offre'],$data2['id']);
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
    header("Location: ../index.php");
?>
