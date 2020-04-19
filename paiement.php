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
    <script>
        function on() {
            document.getElementById("overlay").style.display = "block";
        }
        function off() {
            document.getElementById("overlay").style.display = "none";
        }

        function onAdresse() {
            $('.adressesEnregistrées').css('display', 'none');
            $('.newAdresse').css('display', '');

            offBtn();

        }
        function offAdresse() {
            $('.newAdresse').css('display', 'none');
            $('.adressesEnregistrées').css('display', '');
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
    <title>ECE ebay</title>
</head>
<body>
    <?php include("./modules/header.php"); ?>
    <div class="FinalisationDeAchat">
        <h1><br>Finalisation de l'achat</h1><br><br>
        <h3>Récapitulatif des achats :</h3>
        <hr width="50%" color="gray">
        <div class="blocGaucheFA">
            <div class="articleFin"> 
                <img src="images/objet1(1).jpg" width="100px">
                <div class="titreDescR">
                    <p>Titre : Pièce ancienne Francaise, 100 Francs, en argent, Panthéon, 1985, rare.</p>
                    <p class="monPanierReference">Référence : 123456789</p>
                    <a href="#" class="suprPanier">Supprimer</a>
                </div>
                <div class="monPanierPrixArticle">
                    <p>12€</p>
                </div>
            </div>
        </div>
        <hr width="50%" color="gray">
        <div class="blocDroitFA">
            <p style="float: left;">Objets (2)</p>
            <p style="float: right;"> Total = 24€</p> 
        </div>
        <h3><br><br>Lieu de livraison et mode de paiement:</h3>
        <hr width="50%" color="gray">
        <div class="infoFinalisationAchat">

            <form action="" method="post">
                <table>
                    <tr>
                        <td>Adresse de livraison :</td>
                        <td><br>
                            <input type="radio" id="type1" name="type"  onclick="offAdresse()" >
                            <label for="acheteur">Adresses enregistrées</label><br>
                            <input type="radio" id="type2" name="type" onclick="onAdresse()" checked>
                            <label for="vendeur">Nouvelle adrresse</label>
                        </td>
                    </tr>
                    <tr class="adressesEnregistrées">
                        <td>Adresses enregistrées :</td><br>
                        <td>
                            <select name="adresses" size="1">
                                <option>adresse 1</option>
                                <option>adresse 2</option>
                            </select>
                        </td><br>
                    </tr>
                    <tr class="newAdresse">
                        <td>Adresse (ligne 1) :</td>
                        <td><input type="text" id="ad1" required></td>
                    </tr>
                    <tr class="newAdresse">
                        <td>Adresse (ligne 2) :</td>
                        <td><input type="text" id="ad2"></td>
                    </tr>
                    <tr class="newAdresse">
                        <td>Ville :</td>
                        <td><input type="text" id="ville" required></td>
                    </tr>
                    <tr class="newAdresse">
                        <td>Code Postal:</td>
                        <td><input type="text" name="cp" required required ></td>
                    </tr>
                    <tr class="newAdresse">
                        <td>Pays ou région:</td>
                        <td><input type="text" name="pr" required></td>
                    </tr>
                    <tr class="newAdresse">
                        <td>Numéro de téléphone:</td>
                        <td><input type="text" name="telephone" required pattern="[0-9]{10}"></td>
                    </tr>
                    <tr>
                        <td>Titulaire de la carte :</td>
                        <td><input type="text" name="tit" required></td>
                    </tr>
                    <tr>
                        <td>Type de carte :</td><br>
                        <td>
                            <select name="carte" size="1">
                                <option>Visa</option>
                                <option>MasterCard</option>
                                <option>American Express</option>
                                <option>Paypal</option>
                            </select>
                        </td><br>
                    </tr>
                    <tr>
                        <td>Numéro :</td>
                        <td><input type="text" required pattern="[0-9]{16}"></td>
                    </tr>
                    <tr>
                        <td>Date d'expiration :</td>
                        <td><input type="month" name="exp" required></td>
                    </tr>
                    <tr>
                        <td>Cryptogramme :</td>
                        <td><input type="password" name="crypt"required pattern="[0-9]{3,4}"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <br><input type="submit" id="fin" value="Finaliser l'achat" class="BoutonPayerLaCommande"><br>
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>
    <?php include("./modules/footer.php"); ?>
</body>
</html>