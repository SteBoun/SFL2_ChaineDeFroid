
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
                                    <h1>Suivie de Livraison</h1>
                                    <p>A free and fully responsive site template</p>
                                </header>
                                <div style="width:100%; height:500%" id="map"></div>
                            </div>
                        </section>

                        <!-- Section -->

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
<script type="text/javascript">
    // Start position for the map (hardcoded here for simplicity,
    // but maybe you want to get this from the URL params)
    var lat = 47.230250
    var lon = -1.563378
    var zoom = 11

    var latPro = 47.132130
    var lonPro = -1.352790

    var map; //complex object of type OpenLayers.Map

    function init() {
        //  document.getElementById('olControlLayerSwitcher .layersDiv').className = 'divA';
        map = new OpenLayers.Map("map", {
            controls: [
                new OpenLayers.Control.Navigation(),
                new OpenLayers.Control.PanZoomBar(),
                new OpenLayers.Control.LayerSwitcher(),
                new OpenLayers.Control.Attribution()],
            maxExtent: new OpenLayers.Bounds(-20037508.34, -20037508.34, 20037508.34, 20037508.34),
            maxResolution: 156543.0399,
            numZoomLevels: 19,
            units: 'm',
            projection: new OpenLayers.Projection("EPSG:900913"),
            displayProjection: new OpenLayers.Projection("EPSG:4326")
        });

        // Define the map layer
        // Here we use a predefined layer that will be kept up to date with URL changes
        layerMapnik = new OpenLayers.Layer.OSM.Mapnik("Mapnik");
        map.addLayer(layerMapnik);
        //layerCycleMap = new OpenLayers.Layer.OSM.CycleMap("CycleMap");
        //map.addLayer(layerCycleMap);
        layerMarkers = new OpenLayers.Layer.Markers("Points");
        map.addLayer(layerMarkers);

        // Add the Layer with the GPX Track
        var lgpx = new OpenLayers.Layer.Vector("Véhicule 1", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "proxi2school.gpx",
                format: new OpenLayers.Format.GPX()
            }),
            style: {strokeColor: "#fbb021", strokeWidth: 5, strokeOpacity: 1},
            projection: new OpenLayers.Projection("EPSG:4326")
        });
        var lgpx1 = new OpenLayers.Layer.Vector("Véhicule 2", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "school2gare.gpx",
                format: new OpenLayers.Format.GPX()
            }),
            style: {strokeColor: "#fbb021", strokeWidth: 5, strokeOpacity: 1},
            projection: new OpenLayers.Projection("EPSG:4326")
        });

        map.addLayer(lgpx);
        map.addLayer(lgpx1);

        var lonLat = new OpenLayers.LonLat(lon, lat).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
        map.setCenter(lonLat, zoom);
        var lonLatPro = new OpenLayers.LonLat(lonPro, latPro).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
        map.setCenter(lonLat, zoom);
        var size = new OpenLayers.Size(21, 25);
        var sizePro = new OpenLayers.Size(20, 33);
        var offset = new OpenLayers.Pixel(-(size.w / 2), -size.h);
        var icon = new OpenLayers.Icon('img/marker.png', size, offset);
        var iconProxidej = new OpenLayers.Icon('img/gps_proxidej.png', sizePro, offset);
        layerMarkers.addMarker(new OpenLayers.Marker(lonLat, icon));
        layerMarkers.addMarker(new OpenLayers.Marker(lonLatPro, iconProxidej));


    }
</script>