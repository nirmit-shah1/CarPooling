<?php
session_start();
if(isset($_SESSION['emailcommanusername']))
{	
	include_once("toptemplate2.php");	
?>
	<html >
	<head>
	<style>
	
	input[type="text"]:focus,input[type="text"].focus {
	  box-shadow: inset 1px 1px 2px 0 #c9c9c9;
	}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link href="style2.css" type="text/css" rel="stylesheet" />	
	<title>Search For Route</title>
		<script>
	function fnchecked(blnchecked)
	{
	if(blnchecked)
	{
	document.getElementById("div1").style.display = "";
	}
	else
	{
	document.getElementById("div1").style.display = "none";
	}
	}
	</script>
		   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
	</script>
	
			<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places,geometry" type="text/javascript"></script>
	
			<script type="text/javascript">
				var locations = new Array();
				var directionsDisplay;
				var directionsService = new google.maps.DirectionsService();
	
				//calculates distance between two points in km's
				function calcDistance(p1, p2){
					return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
				 }
	
				function initialize() {
	
					//alert("Inside Initialize");
					var UserSource = document.getElementById('searchTextFieldSource');
					var UserDestination = document.getElementById('searchTextFieldDestination');
					var DbSource = document.getElementById('searchTextFieldIntermediateSource');
					var DbDestination = document.getElementById('searchTextFieldIntermediateDestination');
	
	
	
					var ACUserSource = new google.maps.places.Autocomplete(UserSource);
					var ACUserDestination = new google.maps.places.Autocomplete(UserDestination);
					var ACDbSource = new google.maps.places.Autocomplete(DbSource);
					var ACDbDestination = new google.maps.places.Autocomplete(DbDestination);
	
					google.maps.event.addListener(ACDbDestination, 'place_changed', function () {
						var place1 = ACUserSource.getPlace();
	
						document.getElementById('city1').value = place1.name;
	
						var place1Lat = place1.geometry.location.lat();
						var place1Lng = place1.geometry.location.lng();
	
						document.getElementById('cityLat1').value = place1Lat;
						document.getElementById('cityLng1').value = place1Lng;
	
						var obj = new Object();
						obj.city = place1.name;
						obj.latitude = place1.geometry.location.lat();
						obj.longitude = place1.geometry.location.lng();
						locations.push(obj);
	
	
						var place2 = ACUserDestination.getPlace();
						document.getElementById('city2').value = place2.name;
						var place2Lat = place2.geometry.location.lat();
						var place2Lng = place2.geometry.location.lng();
						document.getElementById('cityLat2').value = place2Lat;
						document.getElementById('cityLng2').value = place2Lng;
	
						var obj = new Object();
						obj.city = place2.name;
						obj.latitude = place2.geometry.location.lat();
						obj.longitude = place2.geometry.location.lng();
						locations.push(obj);
	
						//For intermediate point Source
						var place3 = ACDbSource.getPlace();
						document.getElementById('city3').value = place3.name;
						var place3Lat = place3.geometry.location.lat();
						var place3Lng = place3.geometry.location.lng();
						document.getElementById('cityLat3').value = place3Lat;
						document.getElementById('cityLng3').value = place3Lng;
	
						 //For intermediate point Destination
						var place4 = ACDbDestination.getPlace();
						document.getElementById('city4').value = place4.name;
						var place4Lat = place4.geometry.location.lat();
						var place4Lng = place4.geometry.location.lng();
						document.getElementById('cityLat4').value = place4Lat;
						document.getElementById('cityLng4').value = place4Lng;
	
						var p1 = new google.maps.LatLng(place1Lat, place1Lng);
						var p2 = new google.maps.LatLng(place2Lat, place2Lng);
	
	
	
						//alert(calcDistance(p1, p2));
	
						directionsDisplay = new google.maps.DirectionsRenderer();
	
						var startPlace = new google.maps.LatLng(place1Lat, place1Lng);
	
						var mapOptions = {
							zoom: 7,
							center: startPlace
						}
	
						var map = new google.maps.Map(document.getElementById('map'), mapOptions);
						directionsDisplay.setMap(map);
	
						var start = $("#city1").val();
						var end = $("#city2").val();
	
						var request = {
							origin: start,
							destination: end,
							travelMode: google.maps.TravelMode.DRIVING
						};
	
						var positionsource = new google.maps.LatLng(place3Lat, place3Lng);
						var positiondestination = new google.maps.LatLng(place4Lat, place4Lng);
	
						/*if(calcDistance(positiondestination, p1)> calcDistance(positiondestination, p2)) {
							alert("Straight path");
						}
						else {
							alert("Reverse path");
						}*/
	
						/*var heading1 = google.maps.geometry.spherical.computeHeading(p1, p2);
						alert("heading1: " + heading1);
	
						alert("heading2: " + heading2);*/
	
						directionsService.route(request, function (result, status) {
							if (status == google.maps.DirectionsStatus.OK) {
								directionsDisplay.setDirections(result);
	
								if ((google.maps.geometry.poly.isLocationOnEdge(positionsource,
									new google.maps.Polyline({ path: google.maps.geometry.encoding.decodePath(result.routes[0].overview_polyline.points) }),
									0.0100000000))&(google.maps.geometry.poly.isLocationOnEdge(positiondestination,
									new google.maps.Polyline({ path: google.maps.geometry.encoding.decodePath(result.routes[0].overview_polyline.points) }),
									0.0100000000))) 
	
								{
	
									alert("Belongs to the path");
									var heading2 = google.maps.geometry.spherical.computeHeading(positionsource, positiondestination);
									if(heading2<0) {
										alert("Reverse direction");
									}
								}
								else {
									alert("Doesnt Belong to the path");
								}
	
							  }
						});
					});
				}
				google.maps.event.addDomListener(window, 'load', initialize);
	
				function refreshMap(locations) {
					google.maps.visualRefresh = true;
					var map = new google.maps.Map(document.getElementById('map'), {
						zoom: 10,
						center: new google.maps.LatLng(locations[0].latitude, locations[0].longitude),
						mapTypeId: google.maps.MapTypeId.ROADMAP
					});
	
					var infowindow = new google.maps.InfoWindow();
					var marker, i;
	
					for (i = 0; i < locations.length; i++) {
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(locations[i].latitude, locations[i].longitude),
							map: map
						});
	
						google.maps.event.addListener(marker, 'click', (function (marker, i) {
							return function () {
								infowindow.setContent(locations[i].city);
								infowindow.open(map, marker);
							}
						})(marker, i));
					}
	
	
				}
			</script>
			
	</head>
	<body>
	<br />
	<p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">Enter The Location To Search</font></p><br />
	<div class="boxinfo">
	<form action="searchback.php" method="get">
	<!--From<input type="text" name="txtFrom" />
	<?php
	/*if(isset($_SESSION['frmerror']))
	{
	echo"enter your source";
	unset($_SESSION['frmerror']);
	}
	?>
	To<input type="text" name="txtTo" />
	<?php
	if(isset($_SESSION['toerror']))
	{
	echo"enter your source";
	unset($_SESSION['toerror']);
	}
	*/?>-->
	<table height="106">
	 <tr><td>From:<input id="searchTextFieldSource" class="text" type="text" name="txtfrom" size="50" value="<?php if(isset($_SESSION['fromvalue'])){ echo $_SESSION['fromvalue'];unset($_SESSION['fromvalue']); } ?>"placeholder="Enter the source" autocomplete="on" runat="server" />  
						<input type="hidden" id="city1" name="city1" />
						<input type="hidden" id="cityLat1" name="cityLat1" />
						<input type="hidden" id="cityLng1" name="cityLng1" />  </td>
	<td>To:<input padding="100px" id="searchTextFieldDestination" class="text" type="text" name="txtto" value="<?php if(isset($_SESSION['tovalue'])){ echo $_SESSION['tovalue'];unset($_SESSION['tovalue']); } ?>" size="50" placeholder="Enter the destination" autocomplete="on" runat="server" />  
						<input type="hidden" id="city2" name="city2" />
						<input type="hidden" id="cityLat2" name="cityLat2" />
						<input type="hidden" id="cityLng2" name="cityLng2" />  </td>
	<td><input class="button-3" type="submit" value="search" name="submit"/></td></tr><tr><td style="padding-left:15px;">					
			<?php if(isset($_SESSION['fromerror'])){ echo "<font color=red>Enter Source Location</font>";unset($_SESSION['fromerror']); } ?></td>
		  <td style="padding-left:15px;">  <?php if(isset($_SESSION['toerror'])){ echo "<font color=red>Enter Destination Location</font>";unset($_SESSION['toerror']); } ?></td></tr>
	</table>
	
	</form>
	</div>
<a href="home.php"><font color="#990000" size="+2"><-Back To home Page</font></a>
	</body>
	</html>
<?php
}
else
	header("location:../index.html");
?>