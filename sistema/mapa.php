
<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <?php include "includes/scripts.php"; ?>
    <title>Mapa de Zonas de Riesgo</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        
        height: 90%;
        width: 1000px;
        top: 100px; 
        left: 1000px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 90%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

<html>
  
  <body>

    <div id="map"></div>

</body>
</html>


    <script>
      var customLabel = {
        Alto: {
          label: 'A'
        },
        Bajo: {
          label: 'B'
        },

        Medio: {
          label: 'M'
        }


      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-6.86997, -75.045851),
          zoom: 5
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
         -- downloadUrl('ubicarzonas.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var idzona = markerElem.getAttribute('idzona');
              var nombre = markerElem.getAttribute('nombre');
              var direccion = markerElem.getAttribute('direccion');
              var tipo = markerElem.getAttribute('tipo');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = nombre
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = direccion
              infowincontent.appendChild(text);
              var icon = customLabel[tipo] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYInDa8633nxmkcWjIEFH3Bo9yPd1yfsc&callback=initMap">
    </script>
  