<?php
    session_start();
    include("connexionBase.php");

    $sql = "SELECT id FROM acheteur WHERE (email='".$_POST['i/e']."' OR pseudo='".$_POST['i/e']."') AND password='".$_POST['mdp']."'";
    $result=mysqli_query($db_handle,$sql);
    if (mysqli_num_rows($result)!=0){
        header("Location: connexion.php?issues");
    }
    $sql = "SELECT id FROM vendeur WHERE (email='".$_POST['i/e']."' OR pseudo='".$_POST['i/e']."') AND password='".$_POST['mdp']."'";
    $result=mysqli_query($db_handle,$sql);
    if (mysqli_num_rows($result)!=0){
        header("Location: connexion.php?issues");
    }

    $sql = "SELECT id FROM acheteur WHERE (email='".$_POST['i/e']."' OR pseudo='".$_POST['i/e']."') AND password='".$_POST['mdp']."'";
    $result=mysqli_query($db_handle,$sql);
    while($data = mysqli_fetch_assoc($result)){
        $_SESSION['id']=$data['id'];
        $_SESSION['type']="acheteur";
    }
    $sql = "SELECT id,admin FROM vendeur WHERE (email='".$_POST['i/e']."' OR pseudo='".$_POST['i/e']."') AND password='".$_POST['mdp']."'";
    $result=mysqli_query($db_handle,$sql);
    while($data = mysqli_fetch_assoc($result)){
        $_SESSION['id']=$data['id'];
        if (!$data['admin']){
            $_SESSION['type']="vendeur";
        }
        else {
            $_SESSION['type']="admin";
        }
    }
    header("Location: index.php");
?>