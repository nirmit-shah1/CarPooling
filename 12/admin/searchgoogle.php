<?php
	include_once("../connection.php");
	session_start();
?>
<html>
<head>
<style type="text/css">
               body {

                       font-family: sans-serif;
                       font-size: 14px;
               }
</style>
       <title>Pillion Search Engine</title>
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

                alert("Inside Initialize");
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
        <body>
		<form action="#" method="post">
           <div>
                   <b>From:</b><input id="searchTextFieldSource" class="text" type="text" name="fromtxt" size="50" value="<?php if(isset($_SESSION['fromvalue'])){ echo $_SESSION['fromvalue'];unset($_SESSION['fromvalue']); } ?>"placeholder="Enter the source" autocomplete="on" runat="server" />
           <?php if(isset($_SESSION['fromerror'])){ echo "<font color=red>Enter Source Location</font>";unset($_SESSION['fromerror']); } ?>
      
                   <b>To:</b><input id="searchTextFieldDestination" class="text" type="text" name="totxt" value="<?php if(isset($_SESSION['tovalue'])){ echo $_SESSION['tovalue'];unset($_SESSION['tovalue']); } ?>" size="50" placeholder="Enter the destination" autocomplete="on" runat="server" />  
				   <?php if(isset($_SESSION['toerror'])){ echo "<font color=red>Enter Source Location</font>";unset($_SESSION['toerror']); } ?>
           
		   <input type="submit" name="btn_next" value="Search" />
		   </b>
		   </form>
		   </div>
		   </body>
		   </html>

<?php
$reg_id=1;//$reg_id=$_SESSION['']
		if(isset($_POST['btn_next']))
		{
		$f=$_POST['fromtxt'];
		$t=$_POST['totxt'];
			if($f==NULL)
			{
				$_SESSION['fromerror']=1;
				//header("location:searchgoogle.php");
			}
			else
			{
				$from=$_POST['fromtxt'];
				$_SESSION['fromvalue']=$from;
			}
			if($t==NULL)
			{
				$_SESSION['toerror']=1;
				header("location:searchgoogle.php");
			}
			else
			{
				$to=$_POST['totxt'];
				$_SESSION['tovalue']=$to;
			}
	echo $from;
	echo $to;
	
$sql1="select * from routedetails  where source like '%".$f."%' AND destination LIKE '%".$t."%' ";
echo $sql1;
?>
<html>
<body>
<table border="2">
<?php 
$result1=mysql_query($sql1);
while($row1=mysql_fetch_array($result1))
{
echo "<tr>";
	//echo "<td>".$row1[1]."</td>";
	$sql2=mysql_query("select *  from signup_details where reg_id=".$row1['reg_id']);
	$row2=mysql_fetch_array($sql2);
	echo "<td>".$row2['firstname']."</td>";
	echo "<td>".$row2['lastname']."</td>";
	echo "<td>".$row1[2]."</td>";
	echo "<td>".$row1[3]."</td>";
	echo "</tr>";
}

}
?>
<?php
/*if($f==$s and $t==$d)
{*/
/*$sql1="select * from routedetails  where source like '%".$f."%' AND destination LIKE '%".$t."%' ";
//echo $sql1;
$result1=mysql_query($sql1);
while($row1=mysql_fetch_array($result1))
{
echo "<tr>";
	echo "<td>".$row1[1]."</td>";
	$sql2=mysql_query("select *  from signup_details where reg_id=".$row1['reg_id']);
	$row2=mysql_fetch_array($sql2);
	echo "<td>".$row2['firstname']."</td>";
	echo "<td>".$row2['lastname']."</td>";
	echo "<td>".$row1[2]."</td>";
	echo "<td>".$row1[3]."</td>";
	ec9.ho "</tr>";
}
*/

?>
</table>
</body>
</html> 