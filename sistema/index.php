<?php 
	session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Geolocalización de Riesgo de Incendios</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
 

 <style>
#map {
        
        height: 92%;
        width: 1500px;
        top: 150px; 
        left: 15px;
         
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 92%;
        margin: 0;
        padding: 10;
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
        1: {
          label: 'A'
        },
        2: {
          label: 'M'
        },

        3: {
          label: 'B'
        }


      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-12.04318, -77.02824),
          zoom: 15
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


       
      function getCircle(magnitude) {
        return {
          path: google.maps.SymbolPath.CIRCLE,
          fillColor: 'red',
          fillOpacity: .2,
          scale: Math.pow(2, 4),
          strokeColor: 'white',
          strokeWeight: .5
        };
      }


      function doNothing() {}
    </script>
    <script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYInDa8633nxmkcWjIEFH3Bo9yPd1yfsc&callback=initMap">
    </script>


	<?php include "includes/footer.php"; ?>
</body>
</html>