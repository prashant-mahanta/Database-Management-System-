<html>
<head>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
</head>
<body>
  <font color="orange">
  <center><h1>Search</h1>

  <form action="test.php" method="post">
  Class: <input type='text' name="class"></input>
  <button type="submit" class="btn btn-primary">OK</button>
  </form>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbName="php1";
  // Create connection
  $conn = new mysqli($servername, $username, $password,$dbName);
  // Check connection
  if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
  }
?>
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $class_name=$_POST['class'];
  $sql="SELECT * from student where class='".$class_name."';";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    ?>
  <table width="100px" class='table table-dark table-striped table-hover'>
    <font style="color:orange"><tr><th>Roll</th><th>Name</th><th>Class</th></tr></font>
    <?php
      while($row = $result->fetch_assoc()) {
          echo "<tr><td> " .$row["roll"]. "</td><td> " . $row["name"]. "</td><td> " .$row["class"]. "</td></tr>";
      }
    ?>
    </table>
<?php
  } else {
      echo "0 results";
  }
}
  $conn->close();
  ?>
</center></font>
</body>
</html>
