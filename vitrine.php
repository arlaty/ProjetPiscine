<?php
    $db_handle =new mysqli('localhost','root','','ece ebay');
    mysqli_set_charset($db_handle, 'utf8'); 
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
        <h1>Articles en vente immédiate:</h1>
        <div class="tableObjet">
            <?php searchObjetParAchat($db_handle,"achat");?>
        </div>
        <h1>Articles en vente à la meilleure offre:</h1>
        <div class="tableObjet">
            <?php searchObjetParAchat($db_handle,"offre");?>
        </div>
        <h1>Articles en vente enchere:</h1>
        <div class="tableObjet">
            <?php searchObjetParAchat($db_handle,"enchere");?>
        </div>
    </div>
    <?php include("./modules/footer.php"); ?>
</body>
</html>

<?php
	function searchObjetParAchat($db_handle,$typeAchat){
        $sql = "SELECT `objetId`, `prix` FROM ".$typeAchat;
        $result=mysqli_query($db_handle,$sql);
        $i=0;
        while($data = mysqli_fetch_assoc($result)){
            if ($i%4==0)
            {
                echo "<div class='tablerow'>";
            }
            echo "<a href='#' class='objet'>";
            searchObjet($db_handle,$data['objetId']);
            echo "<p class='prix'>".$data['prix']."€</p>";
            echo "</a>";
            if ($i%4==3)
            {
                echo "</div>";
            }
            $i++;
        }
        if (($i%4!=3)&&($i!=0))
        {
            echo "</div>";
        }

        if ($i==0)
        {
            echo "<h2>Nous n'avons pas d'objets à vendre</h2>";
        }
	}

	function searchObjet($db_handle,$id){
        $sql = "SELECT `titre`, `image1`FROM `objet` WHERE `id`=".$id;
        $result=mysqli_query($db_handle,$sql);
        while($data = mysqli_fetch_assoc($result)){
            echo "<img src='images/".$data['image1']."'>";
            echo "<p class='titre'>".$data['titre']."</p>";
        }
    }
?>