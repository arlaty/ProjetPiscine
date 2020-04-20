<?php
    session_start();
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
    <div class="carroussel">
        <a href="#" class="prev"><img src="./icon/arrow-left.png" alt="arrow prev"></a>
        <div id="carrousel" >   
            <ul>
                <li><img src="Images/carrousel1.png"/></li>
                <li><img src="Images/carrousel2.png"/></li>
                <li><img src="Images/carrousel3.png"/></li>
            
            </ul>
        </div>
        <a href="#" class="next"><img src="./icon/arrow-right.png" alt="arrow next"></a>
    </div>
    <div class="cat">
        <div class="arrow">
            <h4>Quelques catégories </h4>
            <a href="vitrine.php?main=Catego">Tout afficher <img src="./icon/Arrow_forward.png" alt="arrow_forward" width="26"></a>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="img-thumbnail">
                    <a href="vitrine.php?main=Catego">
                        <img src="images/categorieTresor.jpg" alt="lights" style="width: 100%; opacity: 0.8;">
                        <div class="caption" style="text-align: center;">Catégorie Férraille et Trésor</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="img-thumbnail">
                    <a href="vitrine.php?main=Catego">
                        <img src="images/categorieMusee.jpg" alt="Nature" style="width: 100%; opacity: 0.8;">
                        <div class="caption" style="text-align: center;">Catégorie Musée</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="img-thumbnail">
                    <a href="vitrine.php?main=Catego">
                        <img src="images/categorieAccessoireVIP.jpg" alt="Fjors" style="width: 100%;opacity: 0.8;">
                        <div class="caption" style="text-align: center;">Catégorie Accessoires VIP</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
<!-- Popup qui informe l'utilisateur que l'article est payé -->
    <div id="myModal" class="modal">
    <div class="contenuPopup">
        <div class="headerPopup">
            <span class="close">&times;</span>
            <h2 class="validerP">Félicitation!!</h2>
        </div>
        <div class="bodyPopup">
            <p class="validerP" Id="valider">Votre paiement est cofirmé.</p>
            <p class="validerP">Merci de nous avoir fait confiance.</p>
            <p class="validerP">Votre commande arrivera tres prochainement</p>
            <p class="validerP">Coordialement EbayECEC</p>
        </div>
        <div class="footerPopup">
            <h2 class="validerP"> Revenez vite nous voir ! !</h2>
        </div>
    </div>

</div>
            <script type="text/javascript">
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
    
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
    <?php include("./modules/footer.php"); ?>
</body>
</html>