<?php
  session_start();
  
  if(!isset($_SESSION['username'])) {
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
    header('Location: ' . $home_url);
  }

?>

<!DOCTYPE html>
<html lang="zh-tw">
<head>
  <meta charset="UTF-8" http-equiv="refresh" content="5">

  <title>Highcharts</title>
  <!-- jQuery css and js -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  
  <!--include the highcharts library-->
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>

  <!-- Bootstrap css and js -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <script language="javascript">
    $(document).ready(function(){
        
      $(function initialize(){
        //讀取Query字串
        console.log(location.search);

        var param = location.search.split("?");
        // console.log(param[1]);
        $.ajax({
          url: 'getValue.php',
          data: param[1],
          dataType: 'json',
          success: getDataSuccess
        });
      });

      function getDataSuccess(data){
        $('#con').empty();
        var val = [];
        var stime = [];
        var dataNum = data.length;
        for(var i = 0; i < dataNum; i++)
        {
          val.push(parseInt(data[i]["value"]));
          stime.push(parseInt(data[i]["time"].toString()));
        }

        var ads = data[0]["address"].toString();

        $('#con').highcharts({  
          title: {                //標題
            text: '光度變化',
          },
          subtitle: {             //副標題
            text: ads,
          },
          scrollbar: {            //使圖表可以捲動
            enable: true
          },
          chart: {
            type: 'spline',
            zoomType: 'x'         //使圖表可以zoom
          },
          xAxis: {                //x軸設定
            tickInterval: 1,
            labels:{
              enabled: true,
              formatter: function(){  //以sample time作為x軸的label
                return stime[this.value];
              }
            }
          },
          yAxis: {                //y軸設定
            title: {
              text: 'Light value'
            },
          },
          series: [{              //資料來源
            name: 'light',
            data: val
          }],
          tooltip: {              //按下資料點後顯示內容
            formatter: function(){
              return '<b>' + stime[this.x] + '</b><br><li>' + this.series.name + ': <b>' + this.y + '</b></li>';
            }
          },
          plotOptions: {          //圖形設定
            spline: {
              lineWidth: 3,
              states: {
                hover: {
                  lineWidth: 5
                }
              },
              marker: {
                enabled: true
              }
            }
          }
        });
      }
    });
  </script>
</head>

<body>
<!-- 導航欄 -->
  <div class="navbar navbar-inverse navbar-static-top" role="navigation">
    <!-- 居中效果 -->
    <div class="container">
      <!-- 導航欄header -->
      <div class="navbar-header">
          <!-- 做切換按鈕-->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <!-- bootstrap題目 -->
          <a class="navbar-brand" href="#">Bootstrap theme</a>
      </div>
       區塊元素<ul>，將內容顯示為項目清單，每一項用<li>標記
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Setting</a></li>
              <li><a href="#">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
  <div class="container">
    <div id="con" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>
  
  <div class="container">
    <div class="footer">
      <p>&copy; Company 2014</p>
    </div>
  </div>
</body>
</html>
