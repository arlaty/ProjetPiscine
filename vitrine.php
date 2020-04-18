<?php
    session_start();
    include("traitement/connexionBase.php");
?>

<!DOCTYPE html>
<html >
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <title>ECE ebay</title>
</head>
<body>
    <?php include("./modules/header.php"); ?>
    <div class="vitrine">
        <?php search($db_handle);?>
    </div>
    <?php include("./modules/footer.php"); ?>
</body>
</html>

<?php
    function search($db_handle){
        $today = date("Y-m-d H:i:s");
        if (isset($_GET['main'])){
            if ($_GET['main']=="Catego"){?>
                <h1>Ferrailles et Trésors:</h1>
                <div class="tableObjet">
                    <?php searchObjetParCategories($db_handle,"Ferraille ou Trésor");?>
                </div>
                <h1>Bon pour le musée:</h1>
                <div class="tableObjet">
                    <?php searchObjetParCategories($db_handle,"Bon pour le Musée");?>
                </div>
                <h1>Accessoires VIP:</h1>
                <div class="tableObjet">
                    <?php searchObjetParCategories($db_handle,"Accessoire VIP");?>
                </div><?php
            }
            else if ($_GET['main']=="Achat"){?>
                <h1>Articles en vente immédiate:</h1>
                <div class="tableObjet">
                    <?php searchObjetParAchat($db_handle,"achat WHERE immediat=1",0);?>
                </div>
                <h1>Articles en vente à la meilleure offre:</h1>
                <div class="tableObjet">
                    <?php searchObjetParAchat($db_handle,"achat WHERE offre=1",0);?>
                </div>
                <h1>Articles en vente enchere:</h1>
                <div class="tableObjet">
                    <?php searchObjetParAchat($db_handle,"enchere WHERE fin>'$today'",0);?>
                </div><?php
            }
            else {$i=0;?>
                <div class="tableObjet">
                    <?php $i=searchObjetParAchat($db_handle,"achat WHERE immediat=1 OR offre=1",$i);?>
                    <?php $i=searchObjetParAchat($db_handle,"enchere WHERE fin>'$today'",$i);if (($i%4!=0)&&($i!=0)){echo "</div>";}?>
                </div><?php
            }
        }
        else {$i=0;?>
            <div class="tableObjet">
                <?php $i=searchObjetParAchat($db_handle,"achat WHERE immediat=1 OR offre=1",$i);?>
                <?php $i=searchObjetParAchat($db_handle,"enchere WHERE fin>'$today'",$i);if (($i%4!=0)&&($i!=0)){echo "</div>";}?>
            </div><?php
        }
    }

	function searchObjetParAchat($db_handle,$typeAchat,$i){
        $sql = "SELECT `objetId`, `prix` FROM ".$typeAchat;
        $result=mysqli_query($db_handle,$sql);
        while($data = mysqli_fetch_assoc($result)){
            if ($i%4==0)
            {
                echo "<div class='tablerow'>";
            }
            echo "<a href='objet.php?id=".$data['objetId']."' class='objet'>";
            $sql = "SELECT `titre`, `image1`FROM `objet` WHERE `id`=".$data['objetId'];
            $result2=mysqli_query($db_handle,$sql);
            while($data2 = mysqli_fetch_assoc($result2)){
                echo "<img src='images/".$data2['image1']."'>";
                echo "<p class='titre'>".$data2['titre']."</p>";
            }
            echo "<p class='prix'>".$data['prix']."€</p>";
            echo "</a>";
            if ($i%4==3)
            {
                echo "</div>";
            }
            $i++;
        }
        if (($i%4!=3)&&($i!=0)&&(isset($_GET['main'])))
        {
            echo "</div>";
        }

        if (($i==0)&&(isset($_GET['main'])))
        {
            echo "<h2>Nous n'avons pas d'objets à vendre</h2>";
        }
        return $i;
    }
    
    function searchObjetParCategories($db_handle,$typeCatego){
        $today = date("Y-m-d H:i:s");
        $sql = "SELECT id, titre, image1 FROM objet WHERE categories LIKE '%$typeCatego%'";
        $result=mysqli_query($db_handle,$sql);
        $i=0;
        while($data = mysqli_fetch_assoc($result)){
            if ($i%4==0)
            {
                echo "<div class='tablerow'>";
            }
            $id=$data['id'];
            $sql = "SELECT prix FROM achat WHERE (immediat=1 OR offre=1) AND objetId='$id'";
            $result2=mysqli_query($db_handle,$sql);
            while($data2 = mysqli_fetch_assoc($result2)){
                echo "<a href='objet.php?id=".$data['id']."' class='objet'>";
                echo "<img src='images/".$data['image1']."'>";
                echo "<p class='titre'>".$data['titre']."</p>";
                echo "<p class='prix'>".$data2['prix']."€</p>";
                echo "</a>";
                if ($i%4==3)
                {
                    echo "</div>";
                }
                $i++;
            }
            $sql = "SELECT prix FROM enchere WHERE fin>'$today' AND objetId='$id'";
            $result2=mysqli_query($db_handle,$sql);
            while($data2 = mysqli_fetch_assoc($result2)){
                echo "<a href='objet.php?id=".$data['id']."' class='objet'>";
                echo "<img src='images/".$data['image1']."'>";
                echo "<p class='titre'>".$data['titre']."</p>";
                echo "<p class='prix'>".$data2['prix']."€</p>";
                echo "</a>";
                if ($i%4==3)
                {
                    echo "</div>";
                }
                $i++;
            }
        }
        if (($i%4!=3)&&($i!=0)&&(isset($_GET['main'])))
        {
            echo "</div>";
        }
        if (($i==0)&&(isset($_GET['main'])))
        {
            echo "<h2>Nous n'avons pas d'objets à vendre</h2>";
        }
	}
?>