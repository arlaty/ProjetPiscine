<header>
    <a href="index.php"><img src="./icon/logo.png" alt="logo"class="logo"></a>
    <nav>
        <div class="ligne1">
            <div>
                <form action="" method="post">
                    <input type="text">
                    <button><img src="./icon/loupe-32.png" alt="Rechercher"></button>
                </form>
            </div>
            <?php
                if (!isset($_SESSION['id'])){
                    ?>
                    <div>
                        <a href="connexion.php">Mon ebay 
                        <img src="./icon/login-32.png" alt="login"></a>
                    </div>
                    <?php
                }
                else {
                    ?>
                    <div>
                        <a href="profil.php">Mon ebay 
                        <img src="./icon/profil-32.png" alt="profil"></a>
                    </div>
                    <?php
                }
            ?>
            <?php
                if (!isset($_SESSION['id'])){
                    ?>
                    <div>
                        <a href="connexion.php">Mon panier 
                        <img src="./icon/cart-32.png" alt="cart"></a>
                    </div>
                    <?php
                }
                else if ($_SESSION['type']=="acheteur"){
                    ?>
                    <div>
                        <a href="panier.php">Mon panier 
                        <img src="./icon/cart-32.png" alt="cart"></a>
                    </div>
                    <?php
                }
                else {
                    ?>
                    <div>
                        <a href="traitement/deconnexion.php">Déconnexion 
                        <img src="./icon/logout-32.png" alt="logout"></a>
                    </div>
                    <?php
                }
            ?>
        </div>
        <div class="ligne2">
            <ul>
                <li class="subnav">
                  <a href="vitrine.php?main=Categories"class="subnavbtn" >Catégories</a>
                  <div class="subnav-content">
                    <a href="#company">Ferraille ou Trésor</a>
                    <a href="#team">Bon pour le Musée</a>
                    <a href="#careers">Accessoire VIP</a>
                  </div>
                </li>
                <li class="subnav">
                  <a href="vitrine.php?main=Achat" class="subnavbtn" >Achats</a>
                  <div class="subnav-content">
                    <a href="#company">Achats Immédiats</a>
                    <a href="#team">Enchères</a>
                    <a href="#careers">Meilleures Offres</a>
                  </div>
                </li>
                <?php
                    if (!isset($_SESSION['id'])){
                        echo "<li><a href='connexion.php'>Vendre</a></li>";
                    }
                    else if ($_SESSION['type']!="acheteur"){
                        echo "<li><a href='ajout.php'>Vendre</a></li>";
                    }
                    else {
                        echo "<li><a href='traitement/deconnexion.php'>Déconnexion 
                        <img src='./icon/logout-32.png' alt='logout'></a></li>";
                    }
                ?>
            </ul>
        </div>
    </nav>
</header>