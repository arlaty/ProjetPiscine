<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <title>ECE ebay</title>
</head>
<body>
    <?php include("./modules/header.php"); ?>
    <div>
        <div id="carrousel" >
           <ul>
               <li><img src="Images/promo1.jpg" width="1200" height="400" /></li>
               <li><img src="Images/promo2.jpg" width="1200" height="400" /></li>
               <li><img src="Images/promo3.jpg" width="1200" height="400" /></li>
               <li><img src="Images/promo4.jpg" width="1200" height="400" /></li>
               <li><img src="Images/promo5.jpg" width="1200" height="400" /></li>
           </ul>
       </div>
       <input type="button" value="Précédent" class="prev">
       <input type="button" value="Suivant" class="next">
   </div>
   <?php include("./modules/footer.php"); ?>
</body>
</html>