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
    <ul class="carroussel">
        <li>
            <a href="#" class="prev"><img src="./icon/arrow-left.png" alt="arrow prev"></a>
        </li>    
        <li id="carrousel" >   
            <ul>
                <li><img src="Images/promo1.jpg"/></li>
                <li><img src="Images/promo2.jpg"/></li>
                <li><img src="Images/promo3.jpg"/></li>
                <li><img src="Images/promo4.jpg"/></li>
                <li><img src="Images/promo5.jpg"/></li>
            </ul>
        </li>
        <li>
            <a href="#" class="next"><img src="./icon/arrow-right.png" alt="arrow next"></a>
        </li>
    </ul>
    <div id="cat">
        <p></p>
           <h4>Quelques catégories : </h4>
           <p>
              <a href="#">Tout afficher -></a> 
          </p>

          <div class="row">
            <div class="col-sm-4">
                <div class="img-thumbnail">
                    <a href="#">
                        <img src="images/categorieTresor.jpg" alt="lights" style="width: 100%; opacity: 0.8;">
                        <div class="caption" style="text-align: center;">Catégorie Férraille et Trésor</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="img-thumbnail">
                    <a href="#">
                        <img src="images/categorieMusee.jpg" alt="Nature" style="width: 100%; opacity: 0.8;">
                        <div class="caption" style="text-align: center;">Catégorie Musée</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="img-thumbnail">
                    <a href="#">
                        <img src="images/categorieAccessoireVIP.jpg" alt="Fjors" style="width: 100%;opacity: 0.8;">
                        <div class="caption" style="text-align: center;">Catégorie Accessoires VIP</div>
                    </a>
                </div>
            </div>
        </div>
    <br>
</div>
   <?php include("./modules/footer.php"); ?>
</body>
</html>