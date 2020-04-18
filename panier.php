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
    <?php include("./modules/header.php"); 
    if (!isset($_SESSION['id'])){
        echo"<h1 style='padding:4em;text-align:center;'>Mauvaise requète</h1>";
    }
    else {?>
        <h3 class="monPanierHeader" style="padding:1em;">Mon panier</h3><br>
        <!-- Partie des achats immédits -->
        <div class="achatsImmediats">
            <h5 class="ssTitreCPanier">Achats immédiats</h5>
            <br>
            <?php
                $total=0;
                foreach ($_SESSION['panier']['immediat'] as $key => $value) {
                    $sql = "SELECT `objetId`, `prix` FROM achat WHERE id=".$value;
                    $result=mysqli_query($db_handle,$sql);
                    while($data = mysqli_fetch_assoc($result)){
                        echo "<div class='articlePanier'>";
                        $sql = "SELECT `titre`, `image1`FROM `objet` WHERE `id`=".$data['objetId'];
                        $result2=mysqli_query($db_handle,$sql);
                        while($data2 = mysqli_fetch_assoc($result2)){
                            echo "<img src='images/".$data2['image1']."' width='100px'>";
                            echo "<div class='titreDescR'>
                            <p>Titre : ".$data2['titre']."</p>";
                            echo "<p class='monPanierReference'>Référence : ".$data['objetId']."</p>";
                        }
                        echo "<a href='objet.php?id=".$data['objetId']."' class='suprPanier'>Voir l'article</a>";
                        echo "<a href='#' class='suprPanier'>Supprimer</a>";
                        echo "</div>";
                        echo "<div class='monPanierPrixArticle'>";
                        echo "<p>".$data['prix']."</p>";
                        echo "</div>";
                        echo "</div>";
                        $total+=$data['prix'];
                    }
                }
            ?>
        </div>
        <hr width="25%"  color="black"><!-- Permet de faire une ligne horizontale pour séparer les articles du total --> 
        <!-- Total des achats immédiats -->
        <div class="TotalAchatImmediat">
            <div >
                <p>Objet (<?php echo sizeof($_SESSION['panier']['immediat']);?>)</p>
            </div>
            <div class="prixTotalAI">
                <p><?php echo $total."€";?></p>
            </div>
        </div>
        <button type="button" name="achat" class="finaliserAchat">Finaliser l'achat</button><br><br>
        <hr width="75%"  color="#C8C9CA">
        <!-- div qui regroupe les enchères et les meilleures offre qui permet de les afficher sur le même ligne -->
        <div class="monPanierDev">
            <!-- div qui comprend l'ensemble des enchères de l'acheteur -->
            <div class="encheres">
                <h5 class="ssTitreCPanier">Enchères</h5>
                <br>
                <?php
                    foreach ($_SESSION['panier']['enchere'] as $key => $value) {
                        $sql = "SELECT `objetId`, `prix`,fin FROM enchere WHERE id=".$value;
                        $result=mysqli_query($db_handle,$sql);
                        while($data = mysqli_fetch_assoc($result)){
                            echo "<div class='articlePanier'>";
                            $sql = "SELECT `titre`, `image1`FROM `objet` WHERE `id`=".$data['objetId'];
                            $result2=mysqli_query($db_handle,$sql);
                            while($data2 = mysqli_fetch_assoc($result2)){
                                echo "<img src='images/".$data2['image1']."' width='100px'>";
                                echo "<div class='titreDescR'>
                                <p>Titre : ".$data2['titre']."</p>";
                                echo "<p class='monPanierReference'>Référence : ".$data['objetId']."</p>";
                            }
                            echo "<div class='tpsRestant'>";
                            echo "<p class='infoenchere' style='font-weight: bold'>Temps restant : </p>";
                            $today = new DateTime("now");
                            $fin= new DateTime($data['fin']);
                            $diff= date_diff($fin,$today);
                            echo "<p class='infoenchere' > ".$diff->format("%a j %h h")." </p>";
                            echo "</div>";
                            echo "<div class='infoResultatEnchere'>";
                            echo "<p class='infoenchere'style='font-weight: bold'>Nb participant : </p>";
                            $sql = "SELECT prixMax FROM prixmax WHERE enchereId=".$value;
                            echo "<p class='infoenchere'>".mysqli_num_rows(mysqli_query($db_handle,$sql))."</p>";
                            echo "</div>";
                            echo "<a href='objet.php?id=".$data['objetId']."' class='suprPanier'>Voir l'article</a>";
                            echo "<a href='' class='suprPanier'>Supprimer</a>";
                            echo "</div>";
                            echo "<div class='monPanierPrixArticle'>";
                            echo "<p>".$data['prix']."</p>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                ?>
            </div>
            <!-- div qui comprend l'ensemble des meilleures Offres de l'acheteur -->
            <div class="meilleuresOffres">
                <h5 class="ssTitreCPanier">Meilleures Offres</h5>
                <br>
                <?php
                    foreach ($_SESSION['panier']['offre'] as $key => $value) {
                        $sql = "SELECT `objetId`, `prix` FROM achat WHERE id=".$value;
                        $result=mysqli_query($db_handle,$sql);
                        while($data = mysqli_fetch_assoc($result)){
                            echo "<div class='articlePanier'>";
                            $sql = "SELECT `titre`, `image1`FROM `objet` WHERE `id`=".$data['objetId'];
                            $result2=mysqli_query($db_handle,$sql);
                            while($data2 = mysqli_fetch_assoc($result2)){
                                echo "<img src='images/".$data2['image1']."' width='100px'>";
                                echo "<div class='titreDescR'>
                                <p>Titre : ".$data2['titre']."</p>";
                                echo "<p class='monPanierReference'>Référence : ".$data['objetId']."</p>";
                            }
                            $sql = "SELECT nbNegoc FROM offre WHERE achatId=".$value." AND acheteurId=".$_SESSION['id'];
                            $result3=mysqli_query($db_handle,$sql);
                            while($data3 = mysqli_fetch_assoc($result3)){
                                echo "<p class='infoenchere'> ".$data3['nbNegoc']." offres réalisées </p>";
                            }
                            echo "<a href='objet.php?id=".$data['objetId']."' class='suprPanier'>Voir l'article</a>";
                            echo "<a href='#' class='suprPanier'>Supprimer</a>";
                            echo "</div>";
                            echo "<div class='monPanierPrixArticle'>";
                            echo "<p>".$data['prix']."</p>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                ?>
            </div>
        </div>
        <br>
        <?php
    }
    include("./modules/footer.php"); ?>
</body>
</html>