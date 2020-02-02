<html><body>
  <div id="mapdiv"></div>
  <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
  <script>
    map = new OpenLayers.Map("mapdiv");
    map.addLayer(new OpenLayers.Layer.OSM());

    var lonLat = new OpenLayers.LonLat( -1.352790,47.132130)
      .transform(
            new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
            map.getProjectionObject() // to Spherical Mercator Projection
          );
    var lonLatNantes = new OpenLayers.LonLat( -1.550126,47.212288)
          .transform(
            new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
            map.getProjectionObject() // to Spherical Mercator Projection
          );
          
    var zoom=10;

    var markers = new OpenLayers.Layer.Markers( "Markers" );
    var size = new OpenLayers.Size(50,82);
    var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
    var icon = new OpenLayers.Icon('Images/gps_proxidej.png', size, offset);
    
    map.addLayer(markers);
    markers.addMarker(new OpenLayers.Marker(lonLat,icon));
    
    
    map.setCenter (lonLatNantes, zoom);
    
  </script>
</body></html>