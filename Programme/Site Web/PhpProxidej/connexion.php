<?php
session_start();

include 'include/connection.inc';

if (isset($_GET['action']) && $_GET['action'] = 'login' && !empty($_POST)) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `users` WHERE `login` = '".$login."' AND `mdp`='".$password."'";
    echo $sql;
    $resultat = $connexion->query($sql);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $user = $resultat->fetch();
    if ($user) {
        $_SESSION['errCode'] = 0;
        $_SESSION['prenom'] = $user->prenom;
        $_SESSION['nom'] = $user->nom;
        $_SESSION['role'] = $user->role;
        header('location:index.php');
    } else {
        $_SESSION['errCode'] = 2;
        header('location:connexion.php');
    }
}
?>

<!DOCTYPE HTML>

<html>
    <head>
        <title>ProxiDej</title>

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
                        <div class="content">
                            <form action="connexion.php?action=login" method="post" class="form-horizontal">
                                <fieldset>

                                    <!-- Form Name -->
                                    <center><h1><legend class="col-md-12 control-label">Connexion</legend></h1>
                                    </center>
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="textinput">Identifiant</label>  
                                        <div class="col-md-4">
                                            <input  name="login" type="text" placeholder="" class="form-control input-md">
                                        </div>
                                    </div>

                                    <!-- Password input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="passwordinput">Mot de passe</label>
                                        <div class="col-md-4">
                                            <input  name="password" type="password" placeholder="" class="form-control input-md">
                                        </div>
                                    </div>

                                    <!-- Button -->
                                    <div class="form-group">

                                        <div class="col-md-4 form-group">
                                            <center><button id="singlebutton" type="submit" name="connexion" class="btn btn-primary">Se connecter</button></center>
                                        </div>
                                    </div>
                                    </div>
                        </div>
                </div>
            </div>

                                </fieldset>
                            </form>
