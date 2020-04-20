<?php
    session_start();
    include("traitement/connexionBase.php");
    if (isset($_GET['Ferraille'])){$Ferraille=1;}else{$Ferraille=0;}
    if (isset($_GET['Musee'])){$Musee=1;}else{$Musee=0;}
    if (isset($_GET['VIP'])){$VIP=1;}else{$VIP=0;}
    if (!isset($_GET['Ferraille'])&&!isset($_GET['Musee'])&&!isset($_GET['VIP'])){
        $Ferraille=1;
        $Musee=1;
        $VIP=1;
    }
    $filtreCategories = array(
        'Ferraille ou Trésor' => $Ferraille,
        'Bon pour le Musée' => $Musee,
        'Accessoire VIP' => $VIP,
    );
    $filtreAchat = array(
        'achat' => array('immediat' => 1,
                        'selector' => 'OR',
                        'offre' => 1),
        'enchere' => 1,
    );
    if (isset($_GET['main'])){
        if ($_GET['main']=="Categories"){
            $main="categories";
        }
        else if ($_GET['main']=="Achat"){
            $main="achat";
        }
        else {
            $main="";
        }
    }
    else {
        $main="";
    }
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
        <?php search($db_handle,$main,$filtreCategories,$filtreAchat);?>
    </div>
    <?php include("./modules/footer.php"); ?>
</body>
</html>

<?php
    function search($db_handle,$main,$filtreCategories,$filtreAchat){
        if ($main!=""){
            if ($main=="categories"){
                searchObjetParCategories($db_handle,$filtreCategories,$filtreAchat);
            }
            if ($main=="achat"){
                searchObjetParAchat($db_handle,$filtreCategories,$filtreAchat);
            }
        }
        else {
            echo "<div class='tableObjet'>";
            searchObjet($db_handle,$filtreCategories,$filtreAchat);
            echo "</div>";
        }
    }

    function searchObjet($db_handle,$filtreCategories,$filtreAchat){
        foreach ($filtreCategories as $key => $value) {
            if ($value==1)
            {
                $sql = "SELECT id, titre, image1 FROM objet WHERE categories LIKE '%$key%'";
                $result=mysqli_query($db_handle,$sql);
                $i=0;
                while($data = mysqli_fetch_assoc($result)){
                    $id=$data['id'];
                    foreach ($filtreAchat as $key2 => $value2) {
                        $sql = requeteAchat($key2,$value2)." AND objetId=".$data['id'];
                        $result2=mysqli_query($db_handle,$sql);
                        while($data2 = mysqli_fetch_assoc($result2)){
                            displayobjet($data['id'],$data['image1'],$data['titre'],$data2['prix']);
                            $i++;
                        }
                    }
                }
                if ($i==0)
                {
                    echo "<h2>Nous n'avons pas d'objets à vendre</h2>";
                }
            }
        }
    }

    function searchObjetParCategories($db_handle,$filtreCategories,$filtreAchat){
        foreach ($filtreCategories as $key => $value) {
            if ($value==1)
            {
                echo "<h1>".$key.":</h1>";
                echo "<div class='tableObjet'>";
                $sql = "SELECT id, titre, image1 FROM objet WHERE categories LIKE '%$key%'";
                $result=mysqli_query($db_handle,$sql);
                $i=0;
                while($data = mysqli_fetch_assoc($result)){
                    $id=$data['id'];
                    foreach ($filtreAchat as $key2 => $value2) {
                        $sql = requeteAchat($key2,$value2)." AND objetId=".$data['id'];
                        $result2=mysqli_query($db_handle,$sql);
                        while($data2 = mysqli_fetch_assoc($result2)){
                            displayobjet($data['id'],$data['image1'],$data['titre'],$data2['prix']);
                            $i++;
                        }
                    }
                }
                if ($i==0)
                {
                    echo "<h2>Nous n'avons pas d'objets à vendre</h2>";
                }
                echo "</div>";
            }
        }
    }

    function searchObjetParAchat($db_handle,$filtreCategories,$filtreAchat){
        foreach ($filtreAchat as $key => $value) {
            if (gettype($value)=="integer"){
                echo "<h1>Articles en vente aux enchères:</h1>";
                echo "<div class='tableObjet'>";
                $sql = requeteAchat($key,$value);
                $result=mysqli_query($db_handle,$sql);
                $i=0;
                while($data = mysqli_fetch_assoc($result)){
                    foreach ($filtreCategories as $key2 => $value2) {
                        if ($value2==1){
                            $sql = "SELECT titre,image1 FROM objet WHERE id=".$data['objetId']." AND categories LIKE '$key2'";
                            $result2=mysqli_query($db_handle,$sql);
                            while($data2 = mysqli_fetch_assoc($result2)){
                                displayobjet($data['objetId'],$data2['image1'],$data2['titre'],$data['prix']);
                                $i++;
                            }
                        }
                    }
                }
                if ($i==0)
                {
                    echo "<h2>Nous n'avons pas d'objets à vendre</h2>";
                }
                echo "</div>";
            }
            else {
                foreach ($filtreAchat[$key] as $key3 => $value3) {
                    if (gettype($value3)=="integer"){
                        if ($key3=="offre"){
                            echo "<h1>Articles en vente à la meilleure offre:</h1>";
                            $sql = "SELECT prix,objetId FROM achat WHERE offre=".$value['offre'];
                        }
                        else {
                            echo "<h1>Articles en vente immédiate:</h1>";
                            $sql = "SELECT prix,objetId FROM achat WHERE immediat=".$value['immediat'];
                        }
                        echo "<div class='tableObjet'>";
                        $result=mysqli_query($db_handle,$sql);
                        $i=0;
                        while($data = mysqli_fetch_assoc($result)){
                            foreach ($filtreCategories as $key2 => $value2) {
                                if ($value2==1){
                                    $sql = "SELECT titre,image1 FROM objet WHERE id=".$data['objetId']." AND categories LIKE '$key2'";
                                    $result2=mysqli_query($db_handle,$sql);
                                    while($data2 = mysqli_fetch_assoc($result2)){
                                        displayobjet($data['objetId'],$data2['image1'],$data2['titre'],$data['prix']);
                                        $i++;
                                    }
                                }
                            }
                        }
                        if ($i==0)
                        {
                            echo "<h2>Nous n'avons pas d'objets à vendre</h2>";
                        }
                        echo "</div>";
                    }
                }
            } 
        }
    }
    
    function requeteAchat($key,$value){
        if (gettype($value)=="integer"){
            $today = date("Y-m-d H:i:s");
            if ($value==1){
                $sql = "SELECT prix,objetId FROM enchere WHERE fin>'$today'";
            }
            else {
                $sql = "SELECT prix,objetId FROM enchere WHERE fin<='$today'";
            }
        }
        else {
            $sql = "SELECT prix,objetId FROM achat WHERE (immediat=".$value['immediat']." ".$value['selector']." offre=".$value['offre'].")";
        }
        return $sql;
    }

    function displayobjet($id,$image1,$titre,$prix){
        echo "<a href='objet.php?id=".$id."' class='objet'>";
        echo "<img src='images/".$image1."'>";
        echo "<p class='titre'>".$titre."</p>";
        echo "<p class='prix'>".$prix."€</p>";
        echo "</a>";
    }
?>