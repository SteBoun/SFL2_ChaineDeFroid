<!DOCTYPE HTML>
<?php 
      include 'include/connection.inc';?>
<html>
    <head>
        <title>ProxiDej</title>
        <script src="tri.js" async></script>
    </head>
    <body class="is-preload">

        <!-- Wrapper -->
        <div id="wrapper">

            <!-- Main -->
            <div id="main">
                <div class="inner">

                    <?php include 'include/header.inc.php'; ?>

                    <!-- Banner -->
                    <section id="banner">
                        <table class="table">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Heure</th>
      <th scope="col">Température</th>
      <th scope="col">Adresse</th>
    </tr>
  </thead>
  <tbody>
      <?php 
      $resultat = $connexion->query("SELECT * FROM livraison");
      $resultat->setFetchMode(PDO::FETCH_OBJ);
      $ligne = 1;
      while($livraison = $resultat->fetch()){
        echo '
            <tr>
      <th scope="row">'.$ligne.'</th>
      <td>'.$livraison->dateJ.'</td>
      <td>'.$livraison->temp.'</td>
    </tr>
    ';
      
          $ligne++;
      }
          ?>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
                            
                        </div>
                <table>
  <thead>
    <tr>
      <th>Prénom</th>
      <th>Age</th>
      <th>Abonné</th>
    </tr>
  </thead><tbody>
  <tr>
    <td>Pierre</td>
    <td>29</td>
    <td>oui</td>
  </tr>
  <tr>
    <td>Mathilde</td>
    <td>027</td>
    <td>false</td>
  </tr>
  <tr>
    <td>3Ric</td>
    <td></td>
    <td>??</td>
  </tr>
  <tr>
    <td>Florian</td>
    <td>trente</td>
    <td>01</td>
  </tr>
  </tbody>
</table>
                </div>
            </div>

        

