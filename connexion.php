<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
		function on() {
		document.getElementById("overlay").style.display = "block";
		}

		function off() {
		document.getElementById("overlay").style.display = "none";
		}

		function onAcheteur() {
			$('.form-acheteur').css('display', '');
			offBtn();

		}
		function offAcheteur() {
			$('.form-acheteur').css('display', 'none');
			onBtn();
		}

		function etatBtn() {
		  if(document.getElementById("check").checked){
		  	onBtn();
		  }
		  else {
		  	offBtn();
		  }
		}

		function onBtn(){
			document.getElementById("create").disabled = false;}
		function offBtn(){
			document.getElementById("create").disabled = true;}
	</script>
	<title>Connexion/inscription</title>
</head>
<body>
	
	<div class="en-tete">
        <a href="index.php"><img src="./icon/logo.png" alt="logo"class="logo"></a>
    </div>

    <div class="row">
	    <div class="connexion" id="col">
	    	<h1>S'identifier</h1>
	    	<hr color="black" width="80%">
	    	<br><br>

	    	<form>
	    		<table>
		    		<tr>
		    			<td>Identifiant / E-mail :<br></td>
		    			<td><input type="text" name="i/e" required></td>
		    		</tr>
		    		<tr>
		    			<td>Mot de passe  :<br></td>
		    			<td><input type="text" name="mdp" required></td>
		    		</tr>
		    		<tr>
						<td colspan="2" align="center">
							<br><input type="submit" name="connect" value="Se connecter">
						</td>
					</tr>
				</table>
	    	</form>

		</div>

		<div class="inscription" id="col">
			<h1>S'inscrire</h1>
	    	<hr color="black" width="80%">
	    	<br><br>

	    	<form>
	    		<table>
					<tr>
						<td>Nom :</td>
						<td><input type="text" name="nom" required></td>
					</tr>
					<tr>
						<td>Prénom :</td>
						<td><input type="text" name="prenom" required></td>
					</tr>
					<tr>
						<td>E-mail :</td>
						<td><input type="text" name="email" required></td>
					</tr>
					<tr>
						<td>Adresse (ligne 1) :</td>
						<td><input type="text" name="ad1" required></td>
					</tr>
					<tr>
						<td>Adresse (ligne 2) :</td>
						<td><input type="text" name="ad2"></td>
					</tr>
					<tr>
						<td><br>Type :</td>
						<td>
							<input type="radio" id="type1" name="type" value="acheteur" onclick="onAcheteur()" checked>
							<label for="acheteur">Acheteur</label>
							<input type="radio" id="type2" name="type" value="vendeur" onclick="offAcheteur()">
							<label for="vendeur">Vendeur</label>
						</td>
					</tr>
					<tr class="form-acheteur">
						<td><br>Type de carte :</td>
						<td>
							<select name="carte" size="1">
								<option>Visa</option>
								<option>MasterCard</option>
								<option>American Express</option>
								<option>Paypal</option>
							</select>
						</td>
					</tr>
					<tr class="form-acheteur">
						<td>Titulaire de la carte :</td>
						<td><input type="text" name="tit" required></td>
					</tr>
					<tr class="form-acheteur">
						<td>Numéro :</td>
						<td><input type="number" name="num" step="1" min="00000000000000000" max="99999999999999999" required></td>
					</tr>
					<tr class="form-acheteur">
						<td>Date d'expiration :</td>
						<td><input type="month" name="exp" required></td>
					</tr>
					<tr class="form-acheteur">
						<td>Cryptogramme :</td>
						<td><input type="number" name="crypt" step="1" min="000" max="999" required></td>
					</tr>
					<tr>
						<td><br>Identifiant :</td>
						<td><input type="text" name="identifiant" required></td>
					</tr>
					<tr>
						<td>Mot de passe  :</td>
						<td><input type="text" name="mdp1" required></td>
					</tr>
					<tr>
						<td>Confirmer le mot de passe  :</td>
						<td><input type="text" name="mdp1" required></td>
					</tr>
					<tr class="form-acheteur">
						<td>
							<div>
								<p><br>J'accepte la clause d'offre :</p>
								<div class="clause" onclick="on()">CLAUSE *</div>
							</div> 
						</td>
						<td><input id="check" type="checkbox" name="accepter" onclick="etatBtn()" required></td>
					</tr>
		    		<tr>
						<td colspan="2" align="center">
							<br><button id="create" type="submit" disabled>Créer un compte</button>
						</td>
					</tr>
				</table>

	    	</form>

	    	<!--Pop up Clause d'offre-->
	    	<div id="overlay" onclick="off()">
	    		
				  <div id="text"><h3>
		    				Clause offre
		    			</h3>
		    			<p>
		    				En accpetant la clause d'offre, vous vous engagez en cas de participation à une vente aux enchère ou bien à une vente à la meilleure offre à payer le prix que vous indiquerez au vendeur. <br>
		    				Dans les deux cas, pour participer nous nous permettons de vérifier sur votre compte bacaire que vous disposez bien de la somme indiquée afin de garantir au vendeur qu'il sera payé si vous gagné l'enchère ou bien si vous trouvez un accord lors d'une vente à la mailleure.<br>
		    				Attention, vous devez accepté la clause pour pouvoir créer un compte Acheteur.<br>
		    			</p></div>
		    		
			</div>

		</div>
	</div>

    <?php include("./modules/footer.php"); ?>
</body>
</html>