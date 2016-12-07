<?php
  // Start the session
  require_once('startsession.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>7105056035-Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function(){    
    $("#send").click(function() {
      var account = $("#account").val();
      var password = $("#pwd").val();
      console.log(account);
      console.log(password);
      if(account != '' && password != ''){
        var sendData = "account="+account+"&password="+password;
        $.ajax({
            url:'login.php',
            data:sendData,//參數,若有需要可傳給PHP
            type:"POST",
            success: function(msg){
              // console.log(msg)
              if( msg === "found"){
                function getDir(){
                  var locHref = location.href;        //取得完整路徑，包含檔案名稱
                  var locArr = locHref.split("/");    //用"/"切分，並存至locArr陣列
                  delete locArr[locArr.length - 1];   //刪除locArr陣列的最後一個元素，即檔案名稱
                  return locArr.join("/");            //用"/"毀locArr陣列中的元素合併，傳回字串值
                }
                document.location.href= getDir() + "map.php";
              } else {
                console.log("!!! " + msg);
                console.log("");
                alert("帳號密碼錯誤");
              }
            }, //如果取得成功則執行此函數
            error: function(xhr, ajaxOptions, thrownError){
              console.log('error_status: ' + xhr.status);
              console.log('error_status: ' + thrownError);
            }
        });
      } else {
        alert("You need to input account and password");
      }
    });
  });
  </script>
</head>
<body>

<div class="container">

  <h2>Login-HW4</h2>
  <h3>Account: 7105056035</h3>
  <h3>Password: 123456789</h3>
  <form method="POST">
    <div class="form-group">
      <label for="account">Student ID:</label>
      <input type="account" class="form-control" id="account" name="account">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    </div>
    <input type="button" id="send" class="btn btn-info" value="Login">
  </form>
</div>

</body>
</html>
