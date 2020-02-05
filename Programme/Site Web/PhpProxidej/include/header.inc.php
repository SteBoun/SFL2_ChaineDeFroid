<!-- Header -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="stylesheet" href="assets/css/main.css" />					
<header id="header">
    <a href="index.php" class="logo"><span class="image object">
            <img src="img/proxidej-logo-mini.png" alt="" />
        </span></a>
    <ul class="icons">
        <?php
        if(isset($_SESSION['prenom']) && isset($_SESSION['nom']) && isset($_SESSION['role'])){
        
             echo '<li><a ><span class="label">'.$_SESSION['nom']." ".$_SESSION['prenom'].'</span></a></li>';
             echo '<li><a href="deconnexion.php" ><span class="label">Déconnexion</span></a></li>';
        }
        else{
           echo '<li><a href="connexion.php" ><span class="label">Connexion</span></a></li>'; 
        }

        
        
                ?>
<!--										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
            <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon brands fa-medium-m"><span class="label">Medium</span></a></li>
        -->									</ul>
</header>
<?php include 'script.inc.php'; ?>