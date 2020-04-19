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
		echo"<h1 style='padding:4em;text-align:center;'>Mauvaise requête</h1>";
	}
	else {?>
		<br>
		<div class='monCompte'>
			<nav id='nav-compte'>
				<ul>
					<li><button class='btn active' id='btn-profil'>Profil</button></li>
					<li>
					<?php
						if($_SESSION['type']=="acheteur"){
							echo"<button class='btn' id='btn-hist'>Historique d'achats</button>";
						}
						else if ($_SESSION['type']=="vendeur"){
							echo"<button class='btn' id='btn-hist'>Historiques de vente</button></li>";
							echo"<li><button class='btn' id='btn-encours'>Ventes en cours</button></li>";
							echo"<li><button class='btn' id='btn-articles'>Articles en vente</button>";
						}
						else {
							echo"<button class='btn' id='btn-vendeurs'>Vendeurs</button></li>";
							echo"<li><button class='btn' id='btn-hist'>Historique de vente général</button></li>";
							echo"<li><button class='btn' id='btn-encours'>Ventes en cours générales</button></li>";
							echo"<li><button class='btn' id='btn-articles'>Tous les articles en vente</button></li>";
							echo"<li><button class='btn' id='btn-admin'>Mes ventes</button>";
						}
					?>
					</li>
					

					<div id='nav-admin' style='display:none'>
					<ul>
						<li><button class="btn2 active2" id="btn2-hist">Historique de ventes personel</button></li>
						<li><button class="btn2" id="btn2-encours">Ventes personnelles en cours</button></li>
						<li><button class="btn2" id="btn2-articles">Articles personnels en vente</button></li>
					</div>
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
						off();
					});		      
					$('#btn-vendeurs').click(function () { 
						$contenu.css('display', 'none'); 
						$current = $contenu.eq(1); 
						$current.css('display', 'block'); 
						off();
					});
					$('#btn-hist').click(function () { 
						$contenu.css('display', 'none'); 
						$current = $contenu.eq(2); 
						$current.css('display', 'block'); 
						off();
					});
					$('#btn-encours').click(function () { 
						$contenu.css('display', 'none'); 
						$current = $contenu.eq(3); 
						$current.css('display', 'block'); 
						off();
					});			      
					$('#btn-articles').click(function () { 
						$contenu.css('display', 'none'); 
						$current = $contenu.eq(4); 
						$current.css('display', 'block'); 
						off();
					});		      
					$('#btn-admin').click(function () { 
						$contenu.css('display', 'none'); 
						$current = $contenu.eq(5); 
						$current.css('display', 'block'); 
						on();
					});
				});

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

				function on() {
					document.getElementById("nav-admin").style.display = "block";
				}

				function off() {
					document.getElementById("nav-admin").style.display = "none";
				}
				function onAjout(){
					document.getElementById("ajout-vendeur").style.display = "block";
					document.getElementById("vitrine-vendeur").style.display = "none";
					document.getElementById("btn-ajout-vendeur").style.display = "none";
				} 

				function offAjout(){
					document.getElementById("ajout-vendeur").style.display = "none";
					document.getElementById("vitrine-vendeur").style.display = "block";
					document.getElementById("btn-ajout-vendeur").style.display = "block";
				} 
				function onAjout(){
					document.getElementById("ajout-vendeur").style.display = "block";
					document.getElementById("vitrine-vendeur").style.display = "none";
					document.getElementById("btn-ajout-vendeur").style.display = "none";
				} 

				function pageVendeur(){

					document.getElementById("vitrine-vendeur").style.display = "none";
					document.getElementById("btn-ajout-vendeur").style.display = "none";
					document.getElementById("vendeur").style.display = "block";
				} 
				function offpageVendeur(){

					document.getElementById("vitrine-vendeur").style.display = "block";
					document.getElementById("btn-ajout-vendeur").style.display = "block";
					document.getElementById("vendeur").style.display = "none";
				} 
			</script>

			<div class='content'>
				<div class='contenu' id='profil' >
					<h3>Profil</h3>
					<hr color='black' width='60%' align='left'>
					<!--VENDEUR  ACHETEUR ADMIN-->
					<form> <!--formulaire à initialiser au valeur du profil-->
	    				<table>
							<?php if ($_SESSION['type']!="acheteur"){
								echo"<tr>";
								echo"<td>Photo de profil :</td>";
								echo"<td><input type='file' id='img-profil' name='img-file'></td>";
								echo"</tr>";
								echo"<tr>";
								echo"<td>Fond d'écran :</td>";
								echo"<td><input type='file' id='img-fond' name='img-file'></td>";
								echo"</tr>";
							}?>
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

				<div class='contenu' id='vendeurs' style='display:none'>
					<h3>Comptes Vendeurs </h3>
					<hr color='black' width='80%' align='left'>
					<div id='btn-ajout-vendeur' onclick='onAjout()'>+ Ajouter un Vendeur</div>
					<div id='vitrine-vendeur'>
						<div onclick='pageVendeur()'>
							<a href='#' class='vendeur'>
							<img src=''> <!--PHOTO DE PROFIL-->
							<p class='nom'>NOM</p> <!--PRENOM DU VENDEUR-->
							<p class='prenom'>PRENOM</p> <!--NOM DU VENDEUR-->
							</a>
						</div>
					</div>
					<div id='ajout-vendeur' style='display:none'>
						<form>
				    		<table>
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
									<td><br>Type :</td>
									<td>
										<input type='radio' id='type2' name='type' value='vendeur'checked >
										<label for='vendeur'>Vendeur</label>
									</td>
								</tr>
								
								<tr>
									<td><br>Identifiant :</td>
									<td><input type='text' name='identifiant' required></td>
								</tr>
								<tr>
									<td>Mot de passe  :</td>
									<td><input type='password' name='mdp1' required></td>
								</tr>
					    		<tr>
									<td colspan='2' align='center'>
										<br><button id='create' type='submit' onclick='offAjout()'>Créer un compte Vendeur</button>
									</td>
								</tr>
							</table>
				    	</form>
					</div>

					<div id='vendeur' style='display:none'>

						<h3>Profil du Vendeur</h3>
						<hr color='black' width='80%' align='left'>
						<img src=''>
						<form>
				    		<table>
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
									<td><br>Identifiant :</td>
									<td><input type='text' name='identifiant' required></td>
								</tr>
								<tr>
									<td>Mot de passe  :</td>
									<td><input type='password' name='mdp1' required></td>
								</tr>
					    		<tr>
									<td colspan='2' align='center'>
										<br><button id='modify' type='submit' onclick="offpageVendeur()">Modifier</button> <button id='delete' type='submit' onclick="offpageVendeur()">Supprimer</button>
									</td>
								</tr>
							</table>
				    	</form>
						
					</div>

				</div>
				<div class='contenu' id='historique' style='display:none' >
					<h3>
					<?php if($_SESSION['type']=="acheteur"){echo"Historique d'achats";}
						  else {echo"Historiques de vente</li>";}?>
					</h3>
					<hr color='black' width='50%' align='left'>
					<?php if($_SESSION['type']!="admin"){diplayObjet($db_handle,"historique");}
						  else { echo "<p><br>AFFICHER LES ARTCICLES QUI ONT ETE VENDUS.<br><br><br><br><br><br><br><br><br><br></p>";}?>
				</div>
				<div class='contenu' id='ventes-en-cours' style='display:none'>
					<h3>Ventes en cours</h3>
					<hr color='black' width='50%' align='left'>
					<?php if($_SESSION['type']!="admin"){diplayObjet($db_handle,"panier");}
						  else { echo"<p><br>AFFICHER LES VENTES EN COURS .<br><br><br><br><br><br><br><br><br><br></p>";}?>
				</div>
				<div class='contenu' id='articles' style='display:none'>
					<h3>Tous les articles en ventes</h3>
					<hr color="black" width="80%" align="left">
					<?php if($_SESSION['type']!="admin"){ echo"<p><br>AFFICHER TOUS LES ARTCICLES EN VENTES DISPONIBLE DE CE VENDEUR.<br><br><br><br><br><br><br><br><br><br></p>";}
						  else { echo"<p><br>AFFICHER TOUS LES ARTCICLES EN VENTES.<br><br><br><br><br><br><br><br><br><br></p>";}?>
				</div>
				<div class='contenu' id='ventes-admin' style='display:none'>
					<h3>Compte Admin</h3>
					<hr color='black' width='90%' align='left'>
					
		            <div class='contentperso'>
						<div class='contenuperso' id='historique' >
							<h3>Historique de ventes</h3>
							<hr color='black' width='80%' align='left'>
							<p><br>AFFICHER LES ARTCICLES QUI ONT ETE VENDUS PAR l'admin.<br><br></p>
						</div>
						<div class='contenuperso' id='ventes-en-cours' style='display:none'>
							<h3>Ventes en cours</h3>
							<hr color='black' width='80%' align='left'>
							<p><br>AFFICHER LES VENTES EN COURS de l'admin.<br><br></p>
						</div>
						<div class='contenuperso' id='articles' style='display:none'>
							<h3>Articles</h3>
							<hr color='black' width='80%' align='left'>
							<p><br>AFFICHER LES ARTCICLES EN VENTES de l'admin.<br><br></p>
						</div>
					</div>
				</div>
			</div>
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
		</div>

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