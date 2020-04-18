<?php
    session_start();
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
    <script type="text/javascript" src="script.js"></script>
    <title>Ajout d'un article</title>

</head>
<body>
    <?php include("./modules/header.php"); ?>
    
    <div class='ajout-content'>
        <h2>Ajouter un article</h2>
        <hr color='black' width='50%' align='center'>
        <br><br>

        <div class='ajout-img' >
            <button class='button button1' onclick='on()'>Ajouter une image ou une video<br></button>
        </div>

        <form>
        <div id='overlay-ajout'>
            <div id='text-ajout'>
                Vous pouvez ajouter jusqu'à 3 photos et une video.<br><br>
                Charger la ou les photos ici :
                <input type='file' id='img-file' name='img-file' multiple><br><br>
                Entrer le lien de la video ici :
                <input type='text' id='lien-video' name='lien-video'>
                <br><button onclick='off()'>Ajouter</button>
            </div>
        </div>
            
                <div class='infos' >
                <table>
                    <tr>
                        <td>Nom de l'article :</td>
                        <td> <input type='text' name='nom' required></td>
                    </tr>
                    <tr>
                        <td><br>Description :</td>
                            <td> <input type='text' name='desc' required></td>
                    </tr>
                    <tr>
                        <td><br>Sélectionner une catégorie :</td>
                         <td> <select name='cate' id='cate' size='1'>
                                <option>Ferraille, trésors</option>
                                <option>Bon pour le Musée</option>
                                <option>Accessoire VIP</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><br>Sélectionner un type d'achat :</td>
                    </tr>
                    <tr>
                        <td><br>Vente immédiate <input id='c1' type='checkbox' name='imm' checked onclick='check1()'></td>
                        <td><br>Vente aux Enchères <input id='c2' type='checkbox' name='encheres' onclick='check2()'></td>                 
                        <td><br>Meilleure offre <input id='c3' type='checkbox' name='bestoffer' onclick='check3()'> </td>
                    </tr>
                    <tr>
                        <td><br>Prix :</td>
                        <td> <input type='number' name='prix' step='0.01' min='1' required></td>
                    </tr>
                    <tr>
                        <td colspan='2' align='center'>
                            <br><button id='add' type='submit'>Ajouter</button>
                        </td>
                    </tr>
                </table>
            </div>
            </form>
            
       
    </div>

    <script>
            function on() {
              document.getElementById('overlay-ajout').style.display = 'block';
            }

            function off() {
              document.getElementById('overlay-ajout').style.display = 'none';
            }
            function check1() {
              document.getElementById('c2').checked = false;
            }
            function check2() { 
              document.getElementById('c1').checked = false;
              document.getElementById('c3').checked = false;
            }
            function check3() {
              document.getElementById('c2').checked = false; 
            }
        </script>

    <?php include("./modules/footer.php"); ?>
</body>
</html>