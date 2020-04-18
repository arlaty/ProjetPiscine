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
		echo"<h1 style='padding:4em;text-align:center;'>Mauvaise requête</h1>";
	}
	else {?>
		<br>
		<div class="monCompte">
			
			<nav id="nav-compte">
				<ul>
					<li><button class="btn active" id="btn-profil">Profil</button></li>
					<div class="compteAdmin">
						<li><button class="btn" id="btn-vendeurs">Vendeurs</button></li>
					</div>
					<li><button class="btn" id="btn-hist">
						<div class="compteAcheteur">Historique d'achats</div>
						<div class="compteVendeur">Historique de vente</div>
						<div class="compteAdmin">Historique de vente général</div>
					</button></li>
					<li><button class="btn" id="btn-encours">
						<div class="compteVendeur">Ventes en cours</div>
						<div class="compteAdmin">Ventes en cours générales</div>
					</button></li>
						<li><button class="btn" id="btn-articles">
						<div class="compteVendeur">Articles en vente</div>
						<div class="compteAdmin">Tous les articles en vente</div>
					</button></li>
					<div class="compteAdmin">
						<li><button class="btn" id="btn-admin">Mes ventes</button></li>
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
					$('#btn-vendeurs').click(function () { 
						$contenu.css('display', 'none'); 
						$current = $contenu.eq(2); 
						$current.css('display', 'block'); 
					});
					$('#btn-hist').click(function () { 
						$contenu.css('display', 'none'); 
						$current = $contenu.eq(3); 
						$current.css('display', 'block'); 
					});
					$('#btn-encours').click(function () { 
						$contenu.css('display', 'none'); 
						$current = $contenu.eq(4); 
						$current.css('display', 'block'); 
					});			      
					$('#btn-articles').click(function () { 
						$contenu.css('display', 'none'); 
						$current = $contenu.eq(5); 
						$current.css('display', 'block'); 
					});		      
					$('#btn-admin').click(function () { 
						$contenu.css('display', 'none'); 
						$current = $contenu.eq(6); 
						$current.css('display', 'block'); 
					});
				});

			</script>


			<div class="content">
				<div class="contenu" id="profil">
					<h3>Profil</h3>
					<hr color="black" width="50%" align="left">
					
					<!--VENDEUR  ACHETEUR ADMIN-->
					<form> <!--formulaire à initialiser au valeur du profil-->
	    				<table>

	    					<!--VENDEUR ADMIN-->
	    					<div class="compteVendeur">
		    					<tr>
									<td>Photo de profil :</td>
									<td><input type='file' id='img-profil' name='img-file'></td>
									<td>Fond d'écran :</td>
									<td><input type='file' id='img-fond' name='img-file'></td>
								</tr>
							</div>

							<tr>
								<td>Nom :</td>
								<td><input type='text' name='nom' required></td>
							</tr>
							<tr>
								<td>Prénom :</td>
								<td><input type='text' name='prenom' required></td>
							</tr>
							<tr>
								<td>E-mail :</td>
								<td><input type='email' name='email' required></td>
							</tr>
							<tr>
								<td>Adresse (ligne 1) :</td>
								<td><input type='text' name='ad1' required></td>
							</tr>
							<tr>
								<td>Adresse (ligne 2) :</td>
								<td><input type='text' name='ad2'></td>
							</tr>
							<tr>
								<td>Ville :</td>
								<td><input type='text' name='ville' required></td>
							</tr>
							<tr>
								<td>Code Postal :</td>
								<td><input type='text' name='CP' required></td>
							</tr>
							<tr>
								<td>Pays :</td>
								<td><input type='text' name='pays' required></td>
							</tr>
							<tr>
								<td>Numéro de téléphone :</td>
								<td><input type='text' name='tel' required></td>
							</tr>
							<tr>
								<td><br><br>Identifiant :</td>
								<td><input type='text' name='identifiant' required></td>
							</tr>
							<tr>
								<td>Mot de passe  :</td>
								<td><input type='password' name='mdp1' required></td>
							</tr>
							<tr>
								<td>Confirmer le mot de passe  :</td>
								<td><input type='password' name='mdp1' required></td>
							</tr>
					
				    		<tr>
								<td colspan='2' align='center'>
									<br><button id='modifier' type='submit'>Modifier</button>
								</td>
							</tr>
						</table>

			    	</form>
				
				</div>

				<div class="contenu" id="vendeurs" style='display:none'>
					
					<h3>Comptes Vendeurs</h3>
					<hr color="black" width="50%" align="left">
					<p><br>AFFICHER Tous les comptes  VENDEURs.<br><br><br><br><br><br><br><br><br><br></p>
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

					<div class="compteAdmin">
					<h3>Historique des ventes</h3>
					<hr color="black" width="50%" align="left">
					<p><br>AFFICHER LES ARTCICLES QUI ONT ETE VENDUS.<br><br><br><br><br><br><br><br><br><br></p>
					</div>

					
				</div>

				<div class="contenu" id="ventes-en-cours" style='display:none'>
					
					<div class="compteVendeur">
					<h3>Ventes en cours</h3>
					<hr color="black" width="50%" align="left">
					<p><br>AFFICHER LES VENTES EN COURS DE CE VENDEUR.<br><br><br><br><br><br><br><br><br><br></p>
					</div>
					<div class="compteAdmin">
					<h3>Ventes en cours</h3>
					<hr color="black" width="50%" align="left">
					<p><br>AFFICHER LES VENTES EN COURS .<br><br><br><br><br><br><br><br><br><br></p>
					</div>

				</div>

				<div class="contenu" id="articles" style='display:none'>
					
					<div class="compteVendeur">
					<h3>Tous les articles en ventes</h3>
					<hr color="black" width="50%" align="left">
					<p><br>AFFICHER TOUS LES ARTCICLES EN VENTES DISPONIBLE DE CE VENDEUR.<br><br><br><br><br><br><br><br><br><br></p>
					</div>
					<div class="compteAdmin">
					<h3>Tous les articles en ventes</h3>
					<hr color="black" width="50%" align="left">
					<p><br>AFFICHER TOUS LES ARTCICLES EN VENTES.<br><br><br><br><br><br><br><br><br><br></p>
					</div>

				</div>

				<div class="contenu" id="ventes-admin" style='display:none'>
					
					<h3>Compte Admin</h3>
					<hr color="black" width="50%" align="left">

					<nav id="nav-admin">
						<ul>
							<li><button class="btn2 active2" id="btn2-hist">Historique de ventes personel</button></li>
							<li><button class="btn2" id="btn2-encours">Ventes personnelles en cours</button></li>
							<li><button class="btn2" id="btn2-articles">Articles personnels en vente</button></li>
						</ul>	
					</nav>
					<script>
						// Add active class to the current button (highlight it) --> https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_active_element
						var header2 = document.getElementById("nav-admin");
						var btns2 = header2.getElementsByClassName("btn2");
						for (var i = 0; i < btns2.length; i++) {
						btns2[i].addEventListener("click", function() {
						var current2 = document.getElementsByClassName("active2");
						current2[0].className = current2[0].className.replace(" active2", "");
						this.className += " active2";
						});
						}

						/*Navigation à gauche*/
						$(document).ready(function () {
							$contenuperso = $('.contentperso .contenuperso');
							$('#btn2-hist').click(function () { 
								$contenuperso.css('display', 'none'); 
								$current2 = $contenuperso.eq(0); 
								$current2.css('display', 'block'); 
							});
							$('#btn2-encours').click(function () { 
								$contenuperso.css('display', 'none'); 
								$current2 = $contenuperso.eq(1); 
								$current2.css('display', 'block'); 
							});			      
							$('#btn2-articles').click(function () { 
								$contenuperso.css('display', 'none'); 
								$current2 = $contenuperso.eq(2); 
								$current2.css('display', 'block'); 
							});
						});

					</script>
		            <div class="contentperso">

						<div class="contenuperso" id="historique" >

							<h3>Historique de ventes</h3>
							<hr color="black" width="50%" align="left">
							<p><br>AFFICHER LES ARTCICLES QUI ONT ETE VENDUS PAR l'admin.<br><br></p>
							

						</div>

						<div class="contenuperso" id="ventes-en-cours" style='display:none'>
							<h3>Ventes en cours</h3>
							<hr color="black" width="80%" align="left">
							<p><br>AFFICHER LES VENTES EN COURS de l'admin.<br><br></p>

						</div>

						<div class="contenuperso" id="articles" style='display:none'>
							<h3>Articles</h3>
							<hr color="black" width="50%" align="left">
							<p><br>AFFICHER LES ARTCICLES EN VENTES de l'admin.<br><br></p>
						</div>

						</div>

						</div>
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