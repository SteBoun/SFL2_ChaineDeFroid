<html>
    <?php
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
        $_SESSION['errCode'] = 1;
        header('location:connexion.php');
    }
    ?>
    <!DOCTYPE HTML>
    <html>
        <head>
            <title>ProxiDej</title>
            <script src="OpenLayers.js"></script>
            <!-- bring in the OpenStreetMap OpenLayers layers.
                     Using this hosted file will make sure we are kept up
                     to date with any necessary changes -->
            <script src="OpenStreetMap.js"></script>
        </head>
        <body class="is-preload" onload="init();">

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
                                    <h1>Historique</h1>
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
    <!-- Form Name -->
<legend>Form Name</legend>

<!-- Multiple Radios (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="radios">Inline Radios</label>
  <div class="col-md-4"> 
    <label class="radio-inline" for="radios-0">
      <input type="radio" name="radios" id="radios-0" value="1" checked="checked">
      1
    </label> 
    <label class="radio-inline" for="radios-1">
      <input type="radio" name="radios" id="radios-1" value="2">
      2
    </label> 
    <label class="radio-inline" for="radios-2">
      <input type="radio" name="radios" id="radios-2" value="3">
      3
    </label> 
    <label class="radio-inline" for="radios-3">
      <input type="radio" name="radios" id="radios-3" value="4">
      4
    </label>
  </div>
</div>
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











            </head>
            <!-- body.onload is called once the page is loaded (call the 'init' function) -->

</html>
