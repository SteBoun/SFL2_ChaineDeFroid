<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    $_SESSION['errCode'] = 1;
    header('location:connexion.php');
}
?>?>
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
                            <header>
                                <h1>Chambre Froide</h1>
                                <p>A free and fully responsive site template</p>
                            </header>
                            <p>Aenean ornare velit lacus, ac varius enim ullamcorper eu. Proin aliquam facilisis ante interdum congue. Integer mollis, nisl amet convallis, porttitor magna ullamcorper, amet egestas mauris. Ut magna finibus nisi nec lacinia. Nam maximus erat id euismod egestas. Pellentesque sapien ac quam. Lorem ipsum dolor sit nullam.</p>
                            <ul class="actions">
                                <li><a href="#" class="button big">Learn More</a></li>
                            </ul>
                        </div>
                        <span class="image object">
                            <img src="images/pic10.jpg" alt="" />
                        </span>
                    </section>



                    <!-- Section -->
                    <section>
                    </section>

                </div>
            </div>
            <!--Footer-->

            <!-- Sidebar -->
            <?php
            include 'include/slider.inc.php';
            include 'include/footer.inc.php';
            ?>








    </body>
</html>