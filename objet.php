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
  <script type="text/javascript">
    $(document).ready(function () {
      $img = $('#carrousel img');
      $videotest = $('#carrousel iframe');

      $('.img1').click(function () {
        $img.css('display', 'none');
        $videotest.css('display','none');
        $currentImg = $img.eq(0);
        $currentImg.css('display', 'block');
      });
      $('.img2').click(function () {
        $img.css('display', 'none');
        $videotest.css('display','none');
        $currentImg = $img.eq(1);
        $currentImg.css('display', 'block');
      });
      $('.img3').click(function () {
        $img.css('display', 'none');
        $videotest.css('display','none');
        $currentImg = $img.eq(2); 
        $currentImg.css('display', 'block'); 
      });
      $('.video1').click(function () {
        $img.css('display', 'none');
        $videotest.css('display', 'block'); 
      });
    });
  </script>
  <title>ECE ebay</title>
</head>
<body>
  <?php include("./modules/header.php"); ?>
  <div class="pageArticle">
    <?php
      if (isset($_GET['id'])){
        $sql = "SELECT * FROM objet WHERE id=".$_GET['id'];
        $result=mysqli_query($db_handle,$sql);
        if (mysqli_num_rows($result)==0){
          echo "<h2>L'article demandé n'existe pas</h2>";
        }
        else{
          while($data = mysqli_fetch_assoc($result)){?>
            <div class='article'>
              <h4><?php echo $data['titre']?></h4>
              <p class='reference'>Référence : <?php echo $data['id']?></p>
              <div class="ligne2">
                <div class='image'>
                  <div id="carrousel">
                    <ul>
                      <li><img src="images/<?php echo $data['image1']?>"></li>
                      <?php
                        if($data['image2']!="")echo"<li><img src='images/".$data['image2']."' style='display: none;'></li>";
                        if($data['image3']!="")echo"<li><img src='images/".$data['image3']."' style='display: none;'></li>";
                        if($data['video']!="")echo"<li><iframe src='".$data['video']."' style='display: none;'></iframe></li>";
                      ?>
                    </ul> 
                  </div>
                  <div class="sousImages">
                      <a class='img1'><img src="images/<?php echo $data['image1']?>"></a>
                      <?php
                      if($data['image2']!="")echo"<a class='img2'><img src='images/".$data['image2']."'></a>";
                      if($data['image3']!="")echo"<a class='img3'><img src='images/".$data['image3']."'></a>";
                      if($data['video']!="")echo"<a class='video1'><iframe src='".$data['video']."'></iframe></a>";
                      ?>
                  </div>
                </div>
                <div class="text">
                  <p>Description :</p>
                  <p><?php echo $data['description']?></p>
                  <?php
                    $sql = "SELECT id,`prix`,immediat,offre FROM achat WHERE (immediat=1 OR offre=1) AND objetId=".$data['id'];
                    $result2=mysqli_query($db_handle,$sql);
                    while($data2 = mysqli_fetch_assoc($result2)){
                      $prix = $data2['prix'];
                      echo "<p class='prix'> Prix : ".$prix."€</p><div class='button'>";
                      if ($data2['immediat']==1){
                        echo"<a href='";
                        if (isset($_SESSION['id'])){if ($_SESSION['type']=="acheteur"){echo "traitement/ajoutPanier.php?final&id=".$data2['id']."&idObjet=".$data['id'];}
                        else {echo "#";}}
                        else {echo "connexion.php";}
                        echo"'>Passer à l'achat</a>
                        <a href='";
                        if (isset($_SESSION['id'])){if ($_SESSION['type']=="acheteur"){echo "traitement/ajoutPanier.php?id=".$data2['id']."&idObjet=".$data['id'];}
                        else {echo "#";}}
                        else {echo "connexion.php";}
                        echo"'>Ajouter au panier</a>";
                      }
                      if ($data2['offre']==1){
                        echo "<a id='myBtn' href='";
                        if (isset($_SESSION['id'])){echo "#";}
                        else {echo "connexion.php";}
                        echo"'>Négocier</a>";
                      }
                    }
                    $today = date("Y-m-d H:i:s");
                    $sql = "SELECT `prix` FROM enchere WHERE fin>'$today' AND objetId=".$data['id'];
                    $result4=mysqli_query($db_handle,$sql);
                    while($data4 = mysqli_fetch_assoc($result4)){
                      $prix = $data2['prix'];
                      echo "<p class='prix'> Prix : ".$prix."€</p><div class='button'>";
                      echo"<a id='myBtn' href='";
                      if (isset($_SESSION['id'])){echo "#";}
                      else {echo "connexion.php";}
                      echo"'>Enchérir</a>";
                    }
                    ?>
                    <div id="myModal" class="negociationPopup">
                      <!-- Modal content -->
                      <div class="BoiteDeNego">
                        <div class="headerBoiteDeNego">
                          <span class="fermerNego">&times;</span>
                          <h2>Négocier !</h2>
                        </div>
                        <div class="bodyBoiteDeNego">
                          <p>Article concerné :</p>
                          <div class='articlePanier'>
                            <img src="images/<?php echo $data['image1']?>" width='100px'>
                            <div class='titreDescR'>
                              <p><?php echo $data['titre']?></p>
                              <p class='monPanierReference'>Référence : <?php echo $data['id']?></p>
                              <?php
                              if (isset($_SESSION['panier']['offre'][$data2['id']])){
                                $sql = "SELECT * FROM offre WHERE achatId=".$_SESSION['panier']['offre'][$data2['id']]." AND acheteurId=".$_SESSION['id'];
                                $result3=mysqli_query($db_handle,$sql);
                                while($data3 = mysqli_fetch_assoc($result3)){
                                  echo "<p class='infoenchere'> ".$data3['nbNegoc']." offres réalisées </p>";
                                }
                              }
                              else {
                                echo "<p class='infoenchere'> 0 offre réalisée </p>";
                              }
                              ?>
                            </div>
                            <div class='monPanierPrixArticle'>
                              <?php
                              if (isset($_SESSION['panier']['offre'][$data2['id']])){
                                if ($_SESSION['type']=="acheteur"){
                                  echo "<p> ".$data3['prixVendeur']." €</p>";
                                }
                                else {
                                  echo "<p> ".$data3['prixAcheteur']." €</p>";
                                }
                              }
                              else {
                                echo "<p> ".$prix." €</p>";
                              }
                              ?>
                            </div>
                          </div>
                          <form>
                            <table>
                              <tr>
                                <td>Mon Prix :</td>
                                <td> <input type='text' name='<?php if($_SESSION['type']=="acheteur"){echo "prixAcheteur";}else{echo "prixVendeur"}?>'  placeholder="votre prix" autocomplete="test" required> €</td>
                              </tr>
                              <tr>
                                <td>Envoyer mon Offre :</td>
                                <td> <input type='submit' name='offre' value="valider"></td>
                              </tr>
                            </table>
                          </form>
                        </div>
                        <div class="footerBoiteDeNego">
                          <img src="icon/logo.png" width="100" style="display: block; margin-left: auto;
                        margin-right: auto;">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
        }  
      }else {
        echo "<h2>Mauvaise requête</h2>";
      }
    ?>
  </div>




<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("fermerNego")[0];

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