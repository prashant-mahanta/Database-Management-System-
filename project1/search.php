<?php
    $key=$_GET['from'];
    $array = array();
    $con=mysql_connect("localhost","root","prashant");
    $db=mysql_select_db("train_test",$con);
    $query=mysql_query("select station from train_path where station LIKE '{$key}%'");
    while($row=mysql_fetch_assoc($query))
    {
      $array[] = $row['station'];
    }
    echo json_encode($array);
?>
