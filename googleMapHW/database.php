<?php

  //user information
  $host = "140.120.13.183";
  $user = "sensor";
  $pass = "123698745";

  //database information
  $databaseName = "sensor_network";
  $tableName = "sensor_value";


  //Connect to mysql database
  $con = mysqli_connect($host,$user,$pass);
  if (!$con) 
  { 
    die("Connection failed: " . mysqli_connect_error()); 
  } 
  mysqli_set_charset($con, "utf8");
  // echo "Connected successfully";
  $dbs = mysqli_select_db($con,$databaseName);
  //Query database for data
  $result = mysqli_query($con ,"SELECT * FROM $tableName WHERE username = '7105056035'");
  //store matrix
  $i=0;
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $employee[$i]=$row;
    $i++;
  }

  //echo result as json 
    echo json_encode($employee,JSON_UNESCAPED_UNICODE);
?>
