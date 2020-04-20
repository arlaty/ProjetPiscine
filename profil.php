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
				function onNewAdresse() {
		            $('.adressesEnregistrees').css('display', 'none');
		            $('.oldAdresse').css('display', 'none');
		            $('.newAdresse').css('display', '');
		        }
		        function offNewAdresse() {
		            $('.newAdresse').css('display', 'none');
		            $('.adressesEnregistrees').css('display', '');
		            $('.oldAdresse').css('display', '');
		            document.getElementById("ad1").required= false;
		            document.getElementById("ad2").required=false;
		            document.getElementById("ville").required=false;
		            document.getElementById("CP").required= false;
		            document.getElementById("pays").required=false;
		            document.getElementById("tel").required=false;
		        }
			</script>
			<div class='content'>
				<div class='contenu' id='profil' 
					<?php
					if ($_SESSION['type']=="acheteur"){
						$sql = "SELECT * FROM acheteur WHERE id=".$_SESSION['id'];
						$result = mysqli_query($db_handle,$sql);
						while($data = mysqli_fetch_assoc($result)){?>
							>
							<h3>Profil</h3>
							<hr color='black' width='60%' align='left'>
							<form action="traitement/modifAcheteur.php" method="post">
								<table>
									<tr>
										<td>Nom :</td>
										<td><input type='text' name='nom' value="<?php echo $data['nom']?>"required></td>
									</tr>
									<tr>
										<td>Prénom :</td>
										<td><input type='text' name='prenom' value="<?php echo $data['prenom']?>"required></td>
									</tr>
									<tr>
										<td>E-mail :</td>
										<td><input type='email' name='email' value="<?php echo $data['email']?>"required></td>
									</tr>
									<tr >
										<td>Adresse (ligne 1) :</td>
										<td><input type='text' name='ad1' value="<?php echo $data['adresse1']?>"required></td>
									</tr>
									<tr>
										<td>Adresse (ligne 2) :</td>
										<td><input type='text' name='ad2' value="<?php echo $data['adresse2']?>"></td>
									</tr>
									<tr>
										<td>Ville :</td>
										<td><input type='text' name='ville' value="<?php echo $data['ville']?>" required></td>
									</tr>
									<tr>
										<td>Code Postal :</td>
										<td><input type='text' name='CP' value="<?php echo $data['cp']?>"required></td>
									</tr>
									<tr>
										<td>Pays :</td>
										<td><input type='text' name='pays' value="<?php echo $data['pays']?>"required></td>
									</tr>
									<tr>
										<td>Numéro de téléphone :</td>
										<td><input type='text' name='tel' value="<?php echo $data['tel']?>"required pattern="[0-9]{10}"></td>
									</tr>
									<tr >
										<td><br>Identifiant :</td>
										<td><input type='text' name='identifiant' value="<?php echo $data['pseudo']?>"required></td>
									</tr>
									<tr>
										<td>Mot de passe  :</td>
										<td><input type='password' name='mdp1' value="<?php echo $data['password']?>"required></td>
									</tr>
									<tr>
										<td>Confirmer le mot de passe  :</td>
										<td><input type='password' name='mdp1' value="<?php echo $data['password']?>" required></td>
									</tr>
									<tr>
										<td colspan='2' align='center'>
											<br><button id='modifier' type='submit'>Modifier</button>
										</td>
									</tr>
								</table>
							</form><?php
						}
					}
					else {
						$sql = "SELECT * FROM vendeur WHERE id=".$_SESSION['id'];
						$result = mysqli_query($db_handle,$sql);
						while($data = mysqli_fetch_assoc($result)){?>
							style="background-image: url('images/<?php echo $data["fondPrefere"];?>");">
							<h3>Profil</h3>
							<hr color='black' width='60%' align='left'>
							<img src="images/<?php echo $data["photo"];?>" alt="pp">
							
							<form enctype="multipart/form-data" action="traitement/modifVendeur.php" method="post">
								<table>
									<tr>
										<td>Photo de profil :</td>
										<td><input type='file' id='img-profil' name='profil'></td>
										<td>Fond d'écran :</td>
										<td><input type='file' id='img-fond' name='fond'></td>
									</tr>
									<tr>
										<td>Nom :</td>
										<td><input type='text' name='nom' value="<?php echo $data['nom']?>"required></td>
									</tr>
									<tr>
										<td>Prénom :</td>
										<td><input type='text' name='prenom' value="<?php echo $data['prenom']?>"required></td>
									</tr>
									<tr>
										<td>E-mail :</td>
										<td><input type='email' name='email' value="<?php echo $data['email']?>"required></td>
									</tr>
									<tr>
										<td><br>Identifiant :</td>
										<td><input type='text' name='identifiant' value="<?php echo $data['pseudo']?>"required></td>
									</tr>
									<tr>
										<td>Mot de passe  :</td>
										<td><input type='password' name='mdp1' value="<?php echo $data['password']?>"required></td>
									</tr>
									<tr>
										<td colspan='2' align='center'>
											<br><button id='modifier' type='submit'>Modifier</button>
										</td>
									</tr>
								</table>
							</form><?php
						}
					}
					?>
				</div>

				<div class='contenu' id='vendeurs' style='display:none'>
					<h3>Comptes Vendeurs </h3>
					<hr color='black' width='80%' align='left'>
					<div id='btn-ajout-vendeur' onclick='onAjout()'>+ Ajouter un Vendeur</div>
					<div id='vitrine-vendeur'>
						<div onclick='pageVendeur()'>
							<?php
							$sql = "SELECT photo,nom,prenom FROM vendeur WHERE admin=0";
							$result = mysqli_query($db_handle,$sql);
							while($data = mysqli_fetch_assoc($result)){
								echo"<a href='#' class='vendeur'>";
								echo"<img src='images/".$data['photo']."'>";
								echo"<p class='nom'>".$data['nom']."</p>";
								echo"<p class='prenom'>".$data['prenom']."</p>";
								echo"</a>";
							}
							?>
						</div>
					</div>
					<div id='ajout-vendeur' style='display:none'>
						<form action='traitement/inscription.php' method='post'>
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
						<?php
						$sql = "SELECT * FROM vendeur WHERE admin=0";
						$result = mysqli_query($db_handle,$sql);
						while($data = mysqli_fetch_assoc($result)){?>
							<h3>Profil du Vendeur</h3>
							<hr color='black' width='80%' align='left'>
							<img src='images/<?php echo $data['photo'] ?>' style='width:120px'>
							<form>
								<table>
									<tr>
										<td>Nom :</td>
										<td><input type='text' name='nom' value="<?php echo $data['nom']?>"required></td>
									</tr>
									<tr>
										<td>Prénom :</td>
										<td><input type='text' name='prenom' value="<?php echo $data['prenom']?>"required></td>
									</tr>
									<tr>
										<td>E-mail :</td>
										<td><input type='email' name='email' value="<?php echo $data['email']?>"required></td>
									</tr>
									<tr>
										<td><br>Identifiant :</td>
										<td><input type='text' name='identifiant' value="<?php echo $data['pseudo']?>"required></td>
									</tr>
									<tr>
										<td>Mot de passe  :</td>
										<td><input type='password' name='mdp1' value="<?php echo $data['password']?>"required></td>
									</tr>
									<tr>
										<td colspan='2' align='center'>
											<br><button id='modify' type='submit' onclick="offpageVendeur()">Modifier</button> <button id='delete' type='submit' onclick="offpageVendeur()">Supprimer</button>
										</td>
									</tr>
								</table>
							</form><?php
						}
						?>
					</div>

				</div>
				<div class='contenu' id='historique' style='display:none' >
					<h3>
					<?php if($_SESSION['type']=="acheteur"){echo"Historique d'achats";}
						  else {echo"Historiques de vente</li>";}?>
					</h3>
					<hr color='black' width='50%' align='left'>
					<?php diplayObjet($db_handle,"historique","tout","historique");?>
				</div>
				<div class='contenu' id='ventes-en-cours' style='display:none'>
					<h3>Ventes en cours</h3>
					<hr color='black' width='50%' align='left'>
					<?php diplayObjet($db_handle,"panier","tout","ventes-en-cours");?>
				</div>
				<div class='contenu' id='articles' style='display:none'>
					<h3>Tous les articles en ventes</h3>
					<hr color="black" width="80%" align="left">
					<?php diplayObjet($db_handle,"panier","tout","articles");?>
				</div>
				<div class='contenu' id='ventes-admin' style='display:none'>
					<h3>Compte Admin</h3>
					<hr color='black' width='90%' align='left'>
					
		            <div class='contentperso'>
						<div class='contenuperso' id='historique' >
							<h3>Historique de ventes</h3>
							<hr color='black' width='80%' align='left'>
							<?php diplayObjet($db_handle,"historique","perso","historique");?>
						</div>
						<div class='contenuperso' id='ventes-en-cours' style='display:none'>
							<h3>Ventes en cours</h3>
							<hr color='black' width='80%' align='left'>
							<?php diplayObjet($db_handle,"panier","perso","ventes-en-cours");?>
						</div>
						<div class='contenuperso' id='articles' style='display:none'>
							<h3>Articles</h3>
							<hr color='black' width='80%' align='left'>
							<?php diplayObjet($db_handle,"panier","perso","articles");?>
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
	function diplayObjet($db_handle,$typeDemande,$perso,$section){
		$filtreCategories = array(
			'Ferraille ou Trésor' => 1,
			'Bon pour le Musée' => 1,
			'Accessoire VIP' => 1,
		);
		if ($section=="historique"){
			if (($_SESSION['type']=="admin")&&($perso=="tout")){
				$filtreAchat = array(
					'achat' => array('immediat' => 0,
									 'selector' => 'AND',
									 'offre' => 0),
					'enchere' => 0,
				);
				searchToutObjet($db_handle,$filtreCategories,$filtreAchat);
			}
			else {
				searchPersoVentesImmediates($db_handle,$typeDemande);
				searchPersoVentesEnCours($db_handle,$typeDemande);
			}
		}
		if ($section=="ventes-en-cours"){
			if (($_SESSION['type']=="admin")&&($perso=="tout")){
				$filtreAchat = array(
					'achat' => array('offre' => 1),
					'enchere' => 1,
				);
				searchToutObjet($db_handle,$filtreCategories,$filtreAchat);
			}
			else {
				searchPersoVentesEnCours($db_handle,$typeDemande);
			}
		}
		if ($section=="articles"){
			if (($_SESSION['type']=="admin")&&($perso=="tout")){
				$filtreAchat = array(
					'achat' => array('immediat' => 1,
									 'offre' => 1),
					'enchere' => 1,
				);
				searchToutObjet($db_handle,$filtreCategories,$filtreAchat);
			}
			else {
				searchPersoVentesImmediates($db_handle,$typeDemande);
				searchPersoVentesEnCours($db_handle,$typeDemande);
			}
		}
	}
?>

<?php
	function searchPersoVentesImmediates($db_handle,$typeDemande){
		echo "<h1>Articles en vente immédiates:</h1>";
		echo "<div class='tableObjet'>";
		$i=0;
		foreach ($_SESSION[$typeDemande]['immediat'] as $key => $value) {
			$sql = "SELECT `objetId`, `prix` FROM achat WHERE id=".$value;
			$result=mysqli_query($db_handle,$sql);
			while($data = mysqli_fetch_assoc($result)){
				$sql = "SELECT `titre`, `image1`FROM `objet` WHERE `id`=".$data['objetId'];
				$result2=mysqli_query($db_handle,$sql);
				while($data2 = mysqli_fetch_assoc($result2)){
					displayobjet($data['objetId'],$data2['image1'],$data2['titre'],$data['prix']);
					$i++;
				}
			}
		}
		if ($i==0)
		{
			echo "<h2>Nous n'avons pas d'objets à vendre</h2>";
		}
		echo "</div>";
	}
	function searchPersoVentesEnCours($db_handle,$typeDemande){
		echo "<h1>Articles en vente à la meilleure offre:</h1>";
		echo "<div class='tableObjet'>";
		$i=0;
		foreach ($_SESSION[$typeDemande]['offre'] as $key => $value) {
			$sql = "SELECT `objetId`, `prix` FROM achat WHERE id=".$value;
			$result=mysqli_query($db_handle,$sql);
			while($data = mysqli_fetch_assoc($result)){
				$sql = "SELECT `titre`, `image1`FROM `objet` WHERE `id`=".$data['objetId'];
				$result2=mysqli_query($db_handle,$sql);
				while($data2 = mysqli_fetch_assoc($result2)){
					displayobjet($data['objetId'],$data2['image1'],$data2['titre'],$data['prix']);
					$i++;
				}	
			}
		}
		if ($i==0)
		{
			echo "<h2>Nous n'avons pas d'objets à vendre</h2>";
		}
		echo "</div>";
		echo "<h1>Articles en vente aux enchères:</h1>";
        echo "<div class='tableObjet'>";
		foreach ($_SESSION[$typeDemande]['enchere'] as $key => $value) {
			$sql = "SELECT `objetId`, `prix`,fin FROM enchere WHERE id=".$value;
			$result=mysqli_query($db_handle,$sql);
			$i=0;
			while($data = mysqli_fetch_assoc($result)){
				$sql = "SELECT `titre`, `image1`FROM `objet` WHERE `id`=".$data['objetId'];
				$result2=mysqli_query($db_handle,$sql);
				while($data2 = mysqli_fetch_assoc($result2)){
					displayobjet($data['objetId'],$data2['image1'],$data2['titre'],$data['prix']);
					$i++;
				}
			}
		}
		if ($i==0)
		{
			echo "<h2>Nous n'avons pas d'objets à vendre</h2>";
		}
		echo "</div>";
	}

	function searchToutObjet($db_handle,$filtreCategories,$filtreAchat){
        foreach ($filtreAchat as $key => $value) {
            if (gettype($value)=="integer"){
                echo "<h1>Articles en vente enchere:</h1>";
                echo "<div class='tableObjet'>";
                $sql = requeteAchat($key,$value,$key);
                $result=mysqli_query($db_handle,$sql);
                $i=0;
                while($data = mysqli_fetch_assoc($result)){
                    foreach ($filtreCategories as $key2 => $value2) {
                        if ($value2==1){
                            $sql = "SELECT titre,image1 FROM objet WHERE id=".$data['objetId']." AND categories LIKE '$key2'";
                            $result2=mysqli_query($db_handle,$sql);
                            while($data2 = mysqli_fetch_assoc($result2)){
                                displayobjet($data['objetId'],$data2['image1'],$data2['titre'],$data['prix']);
                                $i++;
                            }
                        }
                    }
                }
                if ($i==0)
                {
                    echo "<h2>Nous n'avons pas d'objets à vendre</h2>";
                }
                echo "</div>";
            }
            else {
                foreach ($filtreAchat[$key] as $key3 => $value3) {
                    if (gettype($value3)=="integer"){
                        if ($key3=="offre"){
                            echo "<h1>Articles en vente à la meilleure offre:</h1>";
                        }
                        else {
                            echo "<h1>Articles en vente immédiate:</h1>";
						}
						$sql = requeteAchat($key,$value,$key3);
                        echo "<div class='tableObjet'>";
                        $result=mysqli_query($db_handle,$sql);
                        $i=0;
                        while($data = mysqli_fetch_assoc($result)){
                            foreach ($filtreCategories as $key2 => $value2) {
                                if ($value2==1){
                                    $sql = "SELECT titre,image1 FROM objet WHERE id=".$data['objetId']." AND categories LIKE '$key2'";
                                    $result2=mysqli_query($db_handle,$sql);
                                    while($data2 = mysqli_fetch_assoc($result2)){
                                        displayobjet($data['objetId'],$data2['image1'],$data2['titre'],$data['prix']);
                                        $i++;
                                    }
                                }
                            }
                        }
                        if ($i==0)
                        {
                            echo "<h2>Nous n'avons pas d'objets à vendre</h2>";
                        }
                        echo "</div>";
                    }
                }
            } 
        }
    }

    function requeteAchat($key,$value,$key3){
        if (gettype($value)=="integer"){
            $today = date("Y-m-d H:i:s");
            if ($value==1){
                $sql = "SELECT prix,objetId FROM enchere WHERE fin>'$today'";
            }
            else {
                $sql = "SELECT prix,objetId FROM enchere WHERE fin<='$today'";
            }
        }
        else if (isset($value['selector'])){
            $sql = "SELECT prix,objetId FROM achat WHERE (immediat=".$value['immediat']." ".$value['selector']." offre=".$value['offre'].")";
		}
		else if ($key3=="immediat"){
			$sql = "SELECT prix,objetId FROM achat WHERE immediat=".$value['immediat'];
		}
		else{
			$sql = "SELECT prix,objetId FROM achat WHERE offre=".$value['offre'];
		}
        return $sql;
    }

    function displayobjet($id,$image1,$titre,$prix){
        echo "<a href='objet.php?id=".$id."' class='objet'>";
        echo "<img src='images/".$image1."'>";
        echo "<p class='titre'>".$titre."</p>";
        echo "<p class='prix'>".$prix."€</p>";
        echo "</a>";
    }
?>