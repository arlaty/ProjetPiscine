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
    <!-- Lien permettant de revenir à la page précédente -->
    <h3 class="monPanierHeader">Mon panier</h3><br>
<!-- Partie des achats immédits -->
    <div class="achatsImmediats">

        <h5 class="ssTitreCPanier">Achats immédiats</h5>
        <br>
        <div class="articlePanier"> 
            <img src="images/objet1(1).jpg" width="100px">
            <div class="titreDescR">
                <p>Titre : Pièce ancienne Francaise, 100 Francs, en argent, Panthéon, 1985, rare.</p>
                <p class="monPanierReference">Référence : 123456789</p>
                <button type="button" name="voir" class="suprPanier">Voir l'article</button>
                <button type="button" name="supprimer" class="suprPanier">Supprimer</button>
            </div>
            <div class="monPanierPrixArticle">
                <p>12€</p>
            </div>
        </div>  
    </div>
    <hr width="25%"  color="black"><!-- Permet de faire une ligne horizontale pour séparer les articles du total --> 
    <!-- Total des achats immédiats -->
    <div class="TotalAchatImmediat">
        <div >
            <p>Objet (1)</p>
        </div>
        <div class="prixTotalAI">
            <p>400€</p>
        </div>
    </div>
    <button type="button" name="achat" class="finaliserAchat">Finaliser l'achat</button><br><br>

     <hr width="75%"  color="black">
    <!-- div qui regroupe les enchères et les meilleures offre qui permet de les afficher sur le même ligne -->
    <div class="monPanierDev">


        <!-- div qui comprend l'ensemble des enchères de l'acheteur -->
        <div class="encheres">
            <h5 class="ssTitreCPanier">Enchères</h5>
            <br>
            <div class="articlePanier">
                <img src="images/objet1(1).jpg" width="100px">
                <div class="titreDescR">
                    <p>Titre : Pièce ancienne Francaise, 100 Francs, en argent, Panthéon, 1985, rare.</p>
                    <p class="monPanierReference">Référence : 123456789</p>
                    <div class="tpsRestant">
                        <p class="infoenchere" style="font-weight: bold">Temps restant : </p>
                        <p class="infoenchere" > 1j 15h </p>
                    </div>
                    <div class="infoResultatEnchere">
                        <p class="infoenchere"style="font-weight: bold">Résultat : </p>
                        <p class="infoenchere"> 11 enchères </p>
                    </div>

                </div>
                <div class="monPanierPrixArticle">
                    <p>12€</p>
                </div>
            </div>  
        </div>

        <!-- div qui comprend l'ensemble des meilleures Offres de l'acheteur -->
        <div class="meilleuresOffres">
            <h5 class="ssTitreCPanier">Meilleures Offres</h5>
            <br>
            <div class="articlePanier">
                <img src="images/objet1(1).jpg" width="100px">
                <div class="titreDescR">
                    <p>Titre : Pièce ancienne Francaise, 100 Francs, en argent, Panthéon, 1985, rare.</p>
                    <p class="monPanierReference">Référence : 123456789</p>
                    <p class="infoenchere"> 4 offres réalisées </p>
                    <button type="button" name="voir" class="suprPanier">Voir l'article</button>
                    <button type="button" name="offre1" class="suprPanier">Faire une offre</button>

                </div>
                <div class="monPanierPrixArticle">
                    <p>12€</p>
                </div>
            </div>
            <br>
            <br>
        </div>

    </div>
    <br>

    <?php include("./modules/footer.php"); ?>
</body>
</html>