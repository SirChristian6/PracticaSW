<!DOCTYPE html>
<html>
	<head>
		<?php include '../html/Head.html'?>
		<style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 100%;
            }
            
        </style>
	</head>
	<body>
	  	<?php include '../php/Menus.php' ?>
	  	<section class="main" id="s1" style='overflow-y: scroll;'>
	    	<div>
	    		<?php
                    
	    		    $jsonS = file_get_contents("http://ip-api.com/json/".$_SERVER['SERVER_ADDR']);
					$serv = json_decode($jsonS);
                    $paisS = $serv->country;
					$comunidadS = $serv->region;
					$provinciaS = $serv->regionName;
					$ciudadS = $serv->city;
                    
					$jsonC = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$_SERVER['REMOTE_ADDR']);
					
					$cli = json_decode($jsonC);
					$paisC = $cli->geoplugin_countryName;
					$comunidadC = $cli->geoplugin_region;
					$provinciaC = $cli->geoplugin_regionName;
					$ciudadC = $cli->geoplugin_city;
					$latC=$cli->geoplugin_latitude;
					$longC=$cli->geoplugin_longitude;
				?>
	      		<h2>DATOS DEL AUTOR/AUTORES</h2>
	      		<img align="center" src="../images/husky.jpg" height="200" width="150" />
		      	<div style="text-align: left; margin-left: 5%; margin-right: 5%;font-size: 20px; ">
		      	
			      	<strong>Nombre:</strong> Christian <br>
			      	<strong>Apellidos:</strong> Hernández Pérez <br>
			      	<strong>Especialidad:</strong> Computación <br>
			      	<strong>E-mail de la UPV/EHU:</strong> chernandez018@ikasle.ehu.eus <br>
			      	<br>
			      	<?php
			      		echo("
							<table border=1 style='text-align: center;'>
			      				<tr><th></th><th>Datos del Cliente</th><th>Datos del servidor</th></tr>
			      				<tr><td>Pais</td>     <td>".$paisC."</td><td>".$paisS."</td></tr>
			      				<tr><td>Comunidad</td><td>".$comunidadC."</td><td>".$comunidadS."</td></tr>
			      				<tr><td>Provincia</td><td>".$provinciaC."</td><td>".$provinciaS."</td></tr>
			      				<tr><td>Ciudad</td>   <td>".$ciudadC."</td><td>".$ciudadS."</td></tr>
			      			</table>
			      			<br>
			      			<h3>Según su IP usted se enuentra en: latitud=".$latC." longitud=".$longC."</h3><br>
			      			<div id='map' style='height:300px'></div>
                            
        
						");
			      	?>
			      	
			      	
			      	
			      	
			      	
			      	<br><br>
		      		<table border=1 style='text-align: center;'>
						<tr><th>Fecha</th><th>Previsión</th><th>Temperatura Cº</th><th>Temperatura Minima Cº</th><th>Temperatura Maxima Cº</th><th>Humedad %</th><th>Presión Atmosférica hPa</th><th>Velocidad del Viento m/s</th></tr>
						<tr><td id='fecha'></td><td id='prev'></td><td id='temp'></td><td id='tempMin'></td><td id='tempMax'></td><td id='hum'></td><td id='pres'></td><td id='vel'></tr>
			      	</table>

		  		</div>

	    	</div>
	  	</section>
	  	<script src="../js/jquery-3.4.1.min.js"></script>
		<script src="../js/GetWeather.js"></script>
		
		<?php 
	  	    echo("<script>
	  	            var latitude=".$latC.";
	  	            var longitude=".$longC.";
	  				getWeather(".$latC.",".$longC.");
	  			</script>
			");
	  	?>
	  	<script src="../js/ShowMap.js"></script>
	  	<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBzOHbhvDeWp3jzcchpKUhc1zbcVcIjN4k&callback=initMap'async defer></script>
	  	<?php include '../html/Footer.html' ?>
	</body>
</html>
