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
    <title>Mon ebay</title>
</head>
<body>
	<?php include("./modules/header.php"); 
	if (!isset($_SESSION['id'])){
		echo"<h1 style='padding:4em;text-align:center;'>Mauvaise requète</h1>";
	}
	else {?>
		<br>
		<div class="monCompte">
			
			<nav id="nav-compte">
				<ul>
					<li><button class="btn active" id="btn-profil">Profil</button></li>
					<li><button class="btn" id="btn-hist">
					<div class="compteAcheteur" >
						Historique d'achats
					</div>

					<div class="compteVendeur">
						Historique de vente
					</div></button></li>
					<div class="compteVendeur">
						<li><button class="btn" id="btn-encours">Ventes en cours</button></li>
						<li><button class="btn" id="btn-articles">Articles en vente</button></li>
					</div>
				</ul>	
			</nav>
			<script>
				// Add active class to the current button (highlight it) --> https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_active_element
				var header = document.getElementById("nav-compte");
				var btns = header.getElementsByClassName("btn");
				for (var i = 0; i < btns.length; i++) {
				btns[i].addEventListener("click", function() {
				var current = document.getElementsByClassName("active");
				current[0].className = current[0].className.replace(" active", "");
				this.className += " active";
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


			<div class="content">
				<div class="contenu" id="profil">
					<h3>Profil</h3>
					<hr color="black" width="50%" align="left">
					<div class="compteAcheteur">
						<div class="infos">
						<p><br>Nom :</p>
						<p>Prénom :</p>
						<p>E-mail :</p>
						<p>Adresse 1 :</p>
						<p>Adresse 2 :</p>

						<h6><br>Coordonnées bancaires :</h6>
						<div class="CB">
							<p>Type de carte :</p>
							<p>Titulaire :</p>
							<p>Numéro :</p> <!--NON VISIBLE **** OU juste les 4 dernier chiffres-->
							<p>Date d'expiration :</p>
							<p>Cryptogramme :</p> <!--NON VISIBLE ****-->
						</div>

						<p><br><br>Identifiant :</p>
						<p>Mot de passe :</p> <!--NON VISIBLE ****-->
						<br>
						</div>

					<button id="modify" type="Submit">Modifier</button>
					
					</div>
					
					<div class="compteVendeur">
					
					<div class="infos">
						<p><br>Nom :</p>
						<p>Prénom :</p>
						<p>E-mail :</p>
						<p>Adresse 1 :</p>
						<p>Adresse 2 :</p>
						<p><br>Identifiant :</p>
						<p>Mot de passe :</p> 
						<!--NON VISIBLE ****-->
						<br>
						</div>

					<button id="modify" type="Submit">Modifier</button>
					
					</div>
					
				</div>

				<div class="contenu" id="historique" style='display:none'>

					<div class="compteAcheteur">
						<h3>Historique d'achats</h3>
						<hr color="black" width="50%" align="left">
						<p><br>AFFICHER LES ARTCICLES QUI ONT ETE ACHETE PAR CET ACHETEUR.<br><br><br><br><br><br><br><br><br><br></p>
					
					</div>
					
					<div class="compteVendeur">
					<h3>Historique de ventes</h3>
					<hr color="black" width="50%" align="left">
					<p><br>AFFICHER LES ARTCICLES QUI ONT ETE VENDUS PAR CE VENDEUR.<br><br><br><br><br><br><br><br><br><br></p>
					</div>

					
				</div>

				<div class="contenu" id="ventes-en-cours" style='display:none'>
					
					<div class="compteVendeur">
					<h3>Ventes en cours</h3>
					<hr color="black" width="50%" align="left">
					<p><br>AFFICHER LES VENTES EN COURS DE CE VENDEUR.<br><br><br><br><br><br><br><br><br><br></p>
					</div>

				</div>

				<div class="contenu" id="articles" style='display:none'>
					
					<div class="compteVendeur">
					<h3>Tous les articles en ventes</h3>
					<hr color="black" width="50%" align="left">
					<p><br>AFFICHER TOUS LES ARTCICLES EN VENTES DISPONIBLE DE CE VENDEUR.<br><br><br><br><br><br><br><br><br><br></p>
					</div>

				</div>
			</div>

			<br>
		</div>
		<?php
	}
	include("./modules/footer.php"); ?>
</body>
</html>