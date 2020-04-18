<?php
    session_start();
    $db_handle =new mysqli('localhost','root','','ebay ece');
    mysqli_set_charset($db_handle, 'utf8');

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
