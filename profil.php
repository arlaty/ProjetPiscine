<?php
    session_start();
    include('traitement/connexionBase.php');
?>

<!DOCTYPE html>
<html >
<head lang='en'>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' href='style.css'>
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <title>Mon ebay</title>
</head>
<body>
	<?php include('./modules/header.php'); 
	if (!isset($_SESSION['id'])){
		echo"<h1 style='padding:4em;text-align:center;'>Mauvaise requète</h1>";
	}
	else {?>
		<br>
		<div class='monCompte'>
			<nav id='nav-compte'>
				<ul>
					<li><button class='btn active' id='btn-profil'>Profil</button></li>
					<li><button class='btn' id='btn-hist'>
					<?php
						if($_SESSION['type']=="acheteur"){
							echo"Historique d'achats";
						}
						else {
							echo"Historiques de vente</li>";
							echo"<li><button class='btn' id='btn-encours'>Ventes en cours</button></li>";
							echo"<li><button class='btn' id='btn-articles'>Articles en vente</button>";
						}
					?>
					</li>
				</ul>	
			</nav>
			<script>
				// Add active class to the current button (highlight it) --> https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_active_element
				var header = document.getElementById('nav-compte');
				var btns = header.getElementsByClassName('btn');
				for (var i = 0; i < btns.length; i++) {
				btns[i].addEventListener('click', function() {
				var current = document.getElementsByClassName('active');
				current[0].className = current[0].className.replace(' active', '');
				this.className += ' active';
				});
				}

				/*Navigation à gauche*/
				$(document).ready(function () {
					$contenu = $('.content .contenu');

					$('#btn-profil').click(function () { 
						$contenu.css('display', 'none'); 
						$current = $contenu.eq(0);  
						$current.css('display', 'block'); 
					});
					$('#btn-hist').click(function () { 
						$contenu.css('display', 'none'); 
						$current = $contenu.eq(1); 
						$current.css('display', 'block'); 
					});
					$('#btn-encours').click(function () { 
						$contenu.css('display', 'none'); 
						$current = $contenu.eq(2); 
						$current.css('display', 'block'); 
					});			      
					$('#btn-articles').click(function () { 
						$contenu.css('display', 'none'); 
						$current = $contenu.eq(3); 
						$current.css('display', 'block'); 
					});
				});
			</script>
			<div class='content'>
				<div class='contenu' id='profil'>
					<h3>Profil</h3>
					<hr color='black' width='50%' align='left'>
					<form class='infos'>
						<br>
						<p>Nom :</p>
						<p>Prénom :</p>
						<p>E-mail :</p>
						<p>Adresse 1 :</p>
						<p>Adresse 2 :</p>
						<h6><br>Coordonnées bancaires :</h6>
						<div class='CB'>
							<p>Type de carte :</p>
							<p>Titulaire :</p>
							<p>Numéro :</p> <!--NON VISIBLE **** OU juste les 4 dernier chiffres-->
							<p>Date d'expiration :</p>
							<p>Cryptogramme :</p> <!--NON VISIBLE ****-->
						</div>
						<p><br><br>Identifiant :</p>
						<p>Mot de passe :</p> <!--NON VISIBLE ****-->
						<br>
						<button id='modify' type='Submit'>Modifier</button>
					</form>
				</div>
				<div class='contenu' id='historique' style='display:none'>
					<h3>
					<?php if($_SESSION['type']=="acheteur"){echo"Historique d'achats";}
						  else {echo"Historiques de vente</li>";}?>
					</h3>
					<hr color='black' width='50%' align='left'>
					<?php diplayObjet($db_handle,"historique");?>
				</div>
				<div class='contenu' id='ventes-en-cours' style='display:none'>
					<h3>Ventes en cours</h3>
					<hr color='black' width='50%' align='left'>
					<?php diplayObjet($db_handle,"panier");?>
				</div>
				<div class='contenu' id='articles' style='display:none'>
					<h3>Tous les articles en ventes</h3>
					<hr color='black' width='50%' align='left'>
				</div>
			</div>
			<br>
		</div>
		<?php
	}
	include('./modules/footer.php'); ?>
</body>
</html>

<?php
	function diplayObjet($db_handle,$typeDemande){
		?>
		<h1>Achats immédiats</h1>
		<div class="tableObjet"><?php
		foreach ($_SESSION[$typeDemande]['immediat'] as $key => $value) {
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
		}?>
		</div>
		<h1>Meilleures Offres</h1>
		<div class="tableObjet">
			<?php searchObjetParAchat($db_handle,"achat WHERE offre=1");?>
		</div>
		<h1>Enchères</h1>
		<div class="tableObjet">
			<?php searchObjetParAchat($db_handle,"enchere WHERE fin>'$today'");?>
		</div><?php

        <div class="achatsImmediats">
            <h5 class="ssTitreCPanier">Achats immédiats</h5>
            <br>
            <?php
                $total=0;
                foreach ($_SESSION[$typeDemande]['immediat'] as $key => $value) {
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
		<br><br>
        <hr width="75%"  color="#C8C9CA">
        <!-- div qui regroupe les enchères et les meilleures offre qui permet de les afficher sur le même ligne -->
        <div class="monPanierDev">
            <!-- div qui comprend l'ensemble des enchères de l'acheteur -->
            <div class="encheres">
                <h5 class="ssTitreCPanier">Enchères</h5>
                <br>
                <?php
                    foreach ($_SESSION[$typeDemande]['enchere'] as $key => $value) {
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
                    foreach ($_SESSION[$typeDemande]['offre'] as $key => $value) {
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
?>