<?php
  session_start();
  if(!isset($_SESSION['username'])) {
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
    header('Location: ' . $home_url);
    
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <title>
      7105056035
    </title>
    <meta charset="utf8">
    <style type="text/css">
      html, body ,#map-canvas{ height: 100%; margin: 0; padding: 0; }  
    </style>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- include jQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <!-- google api key -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-QXK1pggW6kQZ075dDe2gcF7iAcAK2RU">
    </script>

    <script type="text/javascript">
      var map;
      var geocoder;//宣告為全域變數
          
      function initialize() {
        $.ajax({
            url:'database.php',
            data:"",//參數,若有需要可傳給PHP
            dataType:'json',
            success: getDataSuccess, //如果取得成功則執行此函數
            error: function(){
                console.log("error~~~");
            }
        });
      }

      function getDataSuccess(data)//接受成功後
      {
        // console.log(data[0]["address"]);
        var dataNum = data.length;//抓回來的資料筆數
        geocoder = new google.maps.Geocoder();
        var myLatlng = new google.maps.LatLng(24.1223416,120.6742634);
        var mapOptions = {
            
          center: myLatlng,
          zoom: 8
        };
            
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var ads = [];//存放地址的陣列
        for (var i = 0; i<dataNum; i++)
        {
          //檢查地址是否出現過
          if($.inArray(data[i]["address"].toString(),ads) == -1)//若為-1表示沒出現過
          {
            ads.push(data[i]["address"].toString());
            codeAddress(data[i]);//將資料傳入codeAddress(),已進行編碼放置MARKER
          }   
        }
      }
      //地址編碼
      function codeAddress(data)
      {
        var html;
        
        //透過以下解析地址並將之存在陣列中
        geocoder.geocode({'address':data["address"].toString()},function(results,status)
        {
          if(status == google.maps.GeocoderStatus.OK)//若地址解析請求成功
          {
            map.setCenter(results[0].geometry.location);
            //放置標記
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
                title:"address:"+data["address"].toString()+"\n name: "+data["name"],
                animation: google.maps.Animation.DROP
            });
            //按下標記後開啟視窗
            marker.addListener('click', function(){
              html = "";
              html += data["address"];
              var infowindow = new google.maps.InfoWindow(
              {
                  content: html
              });
              infowindow.open(map,marker);
            });

            // 連點兩下標記時的事件(開啟highchart圖表視窗)
            marker.addListener('dblclick', function(){
              // 開啟highchart圖表示
              // 要開啟的即為highchart.html，記得將地址作為參數傳過去。
              window.open('highchart.php?add=' + data["address"].toString(), data["address"].toString(), config="height=800,width=1200");
            });

          }
          else//若地址解析請求失敗
          {
            var timeout = 300;
            if(status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT)//超過請求數量限制，則會延遲一段時間重新請求
            {
              setTimeout(function(){codeAddress(data);},timeout);
            }
            else//其他錯誤
            {
              alert("not successful for the reason :"+status);
            }
          }
        });
      }   

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>
