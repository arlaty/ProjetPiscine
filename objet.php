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

      $('.img1').click(function () {
        $img.css('display', 'none');
        $currentImg = $img.eq(0);
        $currentImg.css('display', 'block');
      });
      $('.img2').click(function () {
        $img.css('display', 'none');
        $currentImg = $img.eq(1);
        $currentImg.css('display', 'block');
      });
      $('.img3').click(function () {
        $img.css('display', 'none');
        $currentImg = $img.eq(2); 
        $currentImg.css('display', 'block'); 
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
                      ?>
                    </ul> 
                  </div>
                  <div class="sousImages">
                      <a class='img1'><img src="images/<?php echo $data['image1']?>"></a>
                      <?php
                      if($data['image2']!="")echo"<a class='img2'><img src='images/".$data['image2']."'></a>";
                      if($data['image3']!="")echo"<a class='img3'><img src='images/".$data['image3']."'></a>";
                      ?>
                  </div>
                </div>
                <div class="text">
                  <p>Description :</p>
                  <p><?php echo $data['description']?></p>
                  <?php
                    $sql = "SELECT `prix`,immediat,offre FROM achat WHERE (immediat=1 OR offre=1) AND objetId=".$data['id'];
                    $result2=mysqli_query($db_handle,$sql);
                    while($data2 = mysqli_fetch_assoc($result2)){
                      echo "<p class='prix'> Prix : ".$data2['prix']."€</p><div class='button'>";
                      if ($data2['immediat']==1){
                        echo"<a href='";
                        if (isset($_SESSION['id'])){echo "#";}
                        else {echo "connexion.php";}
                        echo"'>Passer à l'achat</a>
                        <a href='";
                        if (isset($_SESSION['id'])){echo "#";}
                        else {echo "connexion.php";}
                        echo"'>Ajouter au panier</a>";
                      }
                      if ($data2['offre']==1){
                        echo "<a href='";
                        if (isset($_SESSION['id'])){echo "#";}
                        else {echo "connexion.php";}
                        echo"'>Négocier</a>";
                      }
                    }
                    $today = date("Y-m-d H:i:s");
                    $sql = "SELECT `prix` FROM enchere WHERE fin>'$today' AND objetId=".$data['id'];
                    $result2=mysqli_query($db_handle,$sql);
                    while($data2 = mysqli_fetch_assoc($result2)){
                      echo "<p class='prix'> Prix : ".$data2['prix']."€</p><div class='button'>";
                      echo"<a href='";
                      if (isset($_SESSION['id'])){echo "#";}
                      else {echo "connexion.php";}
                      echo"'>Enchérir</a>";
                    }
                  ?>
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
  <?php include("./modules/footer.php"); ?>
</body>
</html>