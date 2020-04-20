<?php
    session_start();
    include("connexionBase.php");
    $nom = isset($_POST["nom"])? $_POST["nom"]: "";
    $description = isset($_POST["desc"])? $_POST["desc"]: "";
    $cate = isset($_POST["cate"])? $_POST["cate"]: "";
    if ($cate=="Ferraille, trésors"){
        $categorie="Ferraille ou Trésor";
    }
    if ($cate=="Accessoire VIP"){
        $categorie="Accessoire VIP";
    }
    if ($cate=="Bon pour le Musée"){
        $categorie="Bon pour le Musée";
    }
    $prix = isset($_POST["prix"])? $_POST["prix"]: "";
    $video = isset($_POST["lien-video"])? $_POST["lien-video"]: "";
    $uploaddir = 'C:/wamp/www/ProjetPiscine/images/';
    $sql="INSERT INTO `objet`(`titre`, `video`, `description`, `categories`) 
    VALUES ('$nom','$video','$description','$categorie')";
    $result = mysqli_query($db_handle, $sql);
    $sql="SELECT * FROM `objet` WHERE titre='$nom' AND video='$video' AND description='$description'";
    $result2 = mysqli_query($db_handle, $sql);
    while($data = mysqli_fetch_assoc($result2)) {
        if ($_FILES['img-file1']['size']!=0) {
            $photo1="objet".$data['id']."(1).".explode(".",$_FILES['img-file1']['name'])[1];
            $uploadfile = $uploaddir . $photo1;
            move_uploaded_file($_FILES['img-file1']['tmp_name'], $uploadfile);
        }
        if ($_FILES['img-file2']['size']!=0) {
            $photo2="objet".$data['id']."(2).".explode(".",$_FILES['img-file2']['name'])[1];
            $uploadfile = $uploaddir . $photo2;
            move_uploaded_file($_FILES['img-file2']['tmp_name'], $uploadfile);
        }
        if ($_FILES['img-file3']['size']!=0) {
            $photo3="objet".$data['id']."(3).".explode(".",$_FILES['img-file3']['name'])[1];
            $uploadfile = $uploaddir . $photo3;
            move_uploaded_file($_FILES['img-file3']['tmp_name'], $uploadfile);
        }
        if ((isset($photo1))&&(isset($photo2))&&(isset($photo3))){
            $sql="UPDATE `objet`SET `image2`='$photo2',`image1`='$photo1',`image3`='$photo3' WHERE id=".$data['id'];
        }
        else if ((isset($photo1))&&(isset($photo2))) {
            $sql="UPDATE `objet`SET `image2`='$photo2',`image1`='$photo1' WHERE id=".$data['id'];
        }
        else if ((isset($photo1))&&(isset($photo3))) {
            $sql="UPDATE `objet`SET `image3`='$photo3',`image1`='$photo1' WHERE id=".$data['id'];
        }
        else if ((isset($photo3))&&(isset($photo2))) {
            $sql="UPDATE `objet`SET `image2`='$photo2',`image3`='$photo3' WHERE id=".$data['id'];
        }
        else if (isset($photo1)) {
            $sql="UPDATE `objet`SET `image1`='$photo1' WHERE id=".$data['id'];
        }
        else if (isset($photo2)) {
            $sql="UPDATE `objet`SET `image2`='$photo2' WHERE id=".$data['id'];
        }
        else if (isset($photo3)) {
            $sql="UPDATE `objet`SET `image3`='$photo3' WHERE id=".$data['id'];
        }
        $result = mysqli_query($db_handle, $sql);
        $immediat = isset($_POST["imm"])? $_POST["imm"]: "";
        $enchere = isset($_POST["encheres"])? $_POST["encheres"]: "";
        $offre = isset($_POST["bestoffer"])? $_POST["bestoffer"]: "";
        $id=$data['id'];
        
        $idVendeur=$_SESSION['id'];
        if (($immediat=="on")&&($offre=="on")){
            $sql="INSERT INTO `achat`(`objetId`, `vendeurId`, `prix`, `immediat`, `offre`) 
            VALUES ('$id','$idVendeur','$prix',1,1)";
        }
        if ($immediat=="on"){
            $sql="INSERT INTO `achat`(`objetId`, `vendeurId`, `prix`, `immediat`, `offre`) 
            VALUES ('$id','$idVendeur','$prix',1,0)";
        }
        if ($offre=="on"){
            $sql="INSERT INTO `achat`(`objetId`, `vendeurId`, `prix`, `immediat`, `offre`) 
            VALUES ('$id','$idVendeur','$prix',0,1)";
        }
        if ($enchere=="on"){
            $date=new DateTime();
            date_add($date,date_interval_create_from_date_string('7 days'));
            $date2=$date->format("Y-m-d H:i:s");
            $sql="INSERT INTO `enchere`(`objetId`, `vendeurId`, `prix`, `fin`) 
            VALUES ('$id','$idVendeur','$prix','$date2')";
        }
        $result3 = mysqli_query($db_handle, $sql);
    }
    header("Location: ../objet.php?id=".$id);
?>