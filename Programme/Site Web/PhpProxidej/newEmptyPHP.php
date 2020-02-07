<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tri JavaScript</title>
    <script src="tri.js" async></script>
    <style>
        table{border-collapse: collapse}
        th,td{border: 1px solid black;padding: 10px 20px}
    </style>
</head>

</html>
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
                 <body>
    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Age</th>
                <th>Abonné</th>
            </tr>
        </thead>
        <tbody>
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
</body>
                                    </div>
                        </div>
                </div>
            </div>

                             
