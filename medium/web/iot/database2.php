<?php

  //user information
  $host = "127.0.0.1";
  $user = "test123";
  $pass = "test123";

  //database information
  $databaseName = "iot";
  $tableName = "temp_humi";


  //Connect to mysql database
  $con = mysqli_connect("localhost",$user,$pass);
  if (!$con) 
  { 
      die("Connection failed: " . mysqli_connect_error()); 
  } 
  // echo "Connected successfully";
  $dbs = mysqli_select_db($con,$databaseName);
  //Query database for data
  $result = mysqli_query($con ,"SELECT * FROM $tableName");
  //store matrix
  $i=0;
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $employee[$i]=$row;
    $i++;
  }

  //echo result as json 
    echo json_encode($employee);
?>
