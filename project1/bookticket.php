<html>
<head>

</head>
<body>
<script type="text/javascript">
</script>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>

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
$from = strtoupper($_POST["type"]);
$to = strtoupper($_POST["typeahead"]);

date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
 $date = $_POST["date1"];



 //echo "First date".$date;
 $choose_date = $date;

$sepparator = '/';
$parts = explode($sepparator, $date);
$month = (int)$parts[1];
$day = (int)$parts[0];
$year = (int)$parts[2];
$date = $parts[2]."-".$parts[1]."-".$parts[0];
session_start();

$dayOfWeek = date("D", mktime(0, 0, 0, $month , $day, $year));

 ?>

 <?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $sql="select c.* from train_days as a,train_days as b,train_info as c where a.station='".$from."' and b.station='".$to."' and a.train_no=b.train_no and a.train_no=c.train_no and a.train_no IN (SELECT train_no from seat_available where date='".$date."');";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    ?>

    <center style="color:red"><h2>Available Trains</h2></center>
    <center>
  <table class='table table-dark table-hover' width="100px" >
    <font style="color:orange"><tr><th>Train Number</th><th>Train Name</th><th>Source</th><th>Destination</th><th>Cost</th><th>Date</th><th>Day</th></tr></font>


    <?php
      while($row = $result->fetch_assoc()) {
      	$_SESSION['train_no'] = $row["train_no"];
        $_SESSION['date'] = $date;
        $d1=$conn->query("select distance from train_path where train_no=".$row["train_no"]." and station='".$from."';");
        $d2=$conn->query("select distance from train_path where train_no=".$row["train_no"]." and station='".$to."';");
        $d11=$d1->fetch_assoc();
        $d22=$d2->fetch_assoc();
        $cost=($d22['distance']-$d11['distance'])*0.81;
    echo "<tr><td><a href='train_timetable.php?train=".$row['train_no']."' target='_blank'>" .$row["train_no"]. "</a></td><td> " . $row["train"]. "</td><td> " .$row["source"]. "</td><td>".$row["destination"]."</td><td>".$cost."</td><td>".$date."</td><td>".$dayOfWeek."</td><td>"."<a href='bookdetails.php'><button type='button' class='btn btn-success'>Book Ticket</button></a>"."</td></tr>";


      }
      echo "<br>";
    ?>

    </table>
    </center>
<?php
  } else {
     echo "<font color='red'><center><h2>Sorry!  Trains are not available on this Date </h2></center></font>";

     $sql="select c.*,d.date,a.day from train_days as a,train_days as b,train_info as c,seat_available as d where a.station='".$from."' and b.station='".$to."' and a.train_no=b.train_no and a.train_no=c.train_no and d.train_no=a.train_no and d.date>='".$today."';";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {

  	echo "<table class='table table-dark table-hover' width='100px'><font style='color:orange'><tr><th>Train Number</th><th>Train Name</th><th>Source</th><th>Destination</th><th>Cost</th><th>Date</th><th>Day</th></tr></font>";
     while($row1 = $result->fetch_assoc()) {

     	//session_start();
     	//echo "row train : ".$row1["train_no"];
     	$_SESSION['train_no'] = $row1["train_no"];
      //$_SESSION['date'] = $row1["date"];

        $d1=$conn->query("select distance from train_path where train_no=".$_SESSION['train_no']." and station='".$from."';");
       $d11=$d1->fetch_assoc();
        $d2=$conn->query("select distance from train_path where train_no=".$_SESSION['train_no']." and station='".$to."';");
        $d22=$d2->fetch_assoc();

        $cost=($d22['distance']-$d11['distance'])*0.81;
        
    echo "<tr><td> " .$row1["train_no"]. "</td><td> " . $row1["train"]. "</td><td> " .$row1["source"]. "</td><td>".$row1["destination"]."</td><td>".$cost."</td><td>".$row1["date"]."</td><td>".$row1["day"]."</td><td>"."<a href='bookdetails.php?date=".$row1["date"]."'><button type='button' class='btn btn-success'>Book Ticket</button></a>"."</td></tr>";
      }
      echo "<br>";

      echo "</table>";
  }
}
}
  $conn->close();

?>


</body>
</html>
