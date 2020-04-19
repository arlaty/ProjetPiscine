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
                <li><a href="vitrine.php?main=Categories">Catégories</a></li>
                <li><a href="vitrine.php?main=Achat">Achats</a></li>
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