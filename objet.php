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
  <script type="text/javascript" >
    $(document).ready(function(){
      $('.i1').click(function() {
        var images =$('.i1').attr('src');
        alert(images);
        });
      $('.i2').click(function() {
        var images =$('.i2').attr('src');
        alert(images);
        // Change src attribute of image
        $(ip).attr("src", 'images');
        });
      $('.i3').click(function() {
        var images =$('.i3').attr('src');
        alert(images);
        });
      $('.i4').click(function() {
        var images =$('.i4').attr('src');
        alert(images);
        });

      var $carrousel = $('.image'); // on cible le bloc du carrousel
 $img = $('.sousImages img'); // on cible les images contenues dans le carrousel
 $currentImg = $img.eq(0); // enfin, on cible l'image courante, qui possède l'index i (0 pour l'instant)
 //$test=$('.image img');
 //$test.css('display','none');


 //$img.css('display', 'none'); // on cache les images
 //$currentImg.css('display', 'block'); // on affiche seulement l'image courante
 //si on clique sur le bouton "Suivant"



    });
  </script>
  <title>ECE ebay</title>
</head>
<body>
  <?php include("./modules/header.php"); ?>
  <div id="pageArticle">
  <a href="#"><- Retour en aux articles</a><br><br>
  <div class="article">
    
    <h4>Pièce ancienne Française 100 Francs argent Panthéon 1985 rare</h4>
    <p class="reference">Référence : 123456789</p>
    <div class="image">
      <img src="images/objet1(1).jpg" class="ip">
      <div class="sousImages">
        <ul>
          <li><img src="images/objet1(1).jpg" onclick="" class="i1"></li>
          <li><img src="images/objet1(2).jpg" onclick="" class="i2"></li>
          <li><img src="images/objet1(3).jpg" onclick="" class="i3"></li>
          <li><img src="images/objet1(3).jpg" onclick="" class="i4"></li>
        </ul>   
      </div>
    </div>

    <div class="text">
      <p>Description :</p>
      <p>
        Valeur faciale : 100 Francs <br>
        Millésime : 1983 <br>
        Métal : Argent 900 ‰ <br>
        Diamètre : 31 mm <br>
        Poids : 15 g <br>
        Tranche : Lisse <br>
        Emission : 5 000 972 ex.<br>
        100 Francs Argent Panthéon - France 1983
      </p>
      <p class="prix"> Prix : 11€</p>
        <button type="button" name="achat">Passer à l'achat</button>
        <button type="button" name="panier">Ajouter au panier</button>


    </div>

  </div>
  </div>
  <br>
  <br>

  <?php include("./modules/footer.php"); ?>
</body>
</html>