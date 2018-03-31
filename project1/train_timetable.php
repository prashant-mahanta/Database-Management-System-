<html>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
<head>
	<style>
		th{
			color:orange;
		}

	</style>
</head>
<body>

<?php
  $servername = "localhost";
  $username = "root";
  $password = "*****"; // enter your password
  $dbName="train_test";
  // Create connection
  $conn = new mysqli($servername, $username, $password,$dbName);
  // Check connection
  if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
  }
?>
<?php

	$train_no = $_GET["train"];
	$sql = "select * from train_days where train_no=".$train_no.";";
	 $result = $conn->query($sql);
  	if ($result->num_rows > 0) {

  	echo "<table class='table table-dark table-hover' width='100px'><font style='color:orange'><tr><th>Train Number</th><th>Day</th><th>Station</th><th>Arrival</th><th>Departure</th></tr></font>";
     while($row1 = $result->fetch_assoc()) {

    echo "<tr><td> " .$row1["train_no"]. "</td><td> " . $row1["day"]. "</td><td> " .$row1["station"]. "</td><td>".$row1["arrival"]."</td><td>".$row1["departure"]."</td></tr>";
      }
      echo "<br>";

      echo "</table>";
  }
else{
	echo "0 result";
}	

?>
</body>
</html>
