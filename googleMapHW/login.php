<?php
  // Start the session
  session_start();

  //user information
  $host = "140.120.13.183";
  $user = "sensor";
  $pass = "123698745";

  //database information
  $databaseName = "sensor_network";



  //Connect to mysql database
  $con = mysqli_connect($host,$user,$pass,$databaseName);
  if (!$con) 
  { 
    die("Connection failed: " . mysqli_connect_error()); 
  } 
  mysqli_set_charset($con, "utf8"); 
  $account = mysqli_real_escape_string($con, trim($_POST['account']));
  $password = mysqli_real_escape_string($con, trim($_POST['password']));

  //Query database for data
  if(!empty($account) && !empty($password))
  {
    $query = "SELECT * FROM user_info WHERE username = '$account' AND passwd = '$password' ";
    $result = mysqli_query($con ,$query);
    mysqli_close($con);
    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_array($result);
      
      $_SESSION['username'] = $row['username'];
      setcookie('username', $row['username'], time() + (60 * 60 * 24 * 1));    // expires in 1 days

      echo "found";

    } else {
      echo "notFound";
    
    } 

  } 
?>
