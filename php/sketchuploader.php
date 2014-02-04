<?php

	require('utils.php');
	
	authenticate();
	check_security();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  
  <!-- Force latest IE rendering engine or ChromeFrame if installed -->
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
  
  <link rel="stylesheet" type="text/css" href="../css/sketchuploader.css" />  
  <link rel="stylesheet" type="text/css" href="/luci-static/resources/arduino/style.ugly.css" />
  
  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery.ui.widget.js"></script>
  <script src="../js/jquery.iframe-transport.js"></script>
  <script src="../js/jquery.fileupload.js"></script>
  <script src="../js/sketchuploader.js"></script>
  
  <title>Y&uacute;n Sketch uploader</title>
</head>
<body>
<div id="container">
  <div id="header">
    <div class="wrapper">
      <div id="logo"><img src="/luci-static/resources/arduino/logo.png" alt="Y&uacute;n"/></a></div>
      <div id="logophone"><img src="/luci-static/resources/arduino/logo_phone.png" alt="Y&uacute;n"/></a></div>
    </div>
  </div>
  <div id="content">
    <div class="wrapper">
      <div id="welcome_container">
        <h2>Arduino Y&uacute;n Sketch uploader</h2>
      </div>
	  <div id="configurebtn_container">
          <input class="btTxt submit saveForm" type="button" value="Log out" onclick="location.href='logout.php'">
      </div>
    </div>
    <div class="wrapper divide" id="recap">
      <div id="dashboard_container">
        <div id="sections_container">
          <div class="section">
			<div class="line">
				<div class="lineleft">Load HEX file</div>
				<div class="inputWrapper">
					<input id="fileupload" class="fileInput" type="file" name="files[]" data-url="index.php">
				</div>
				<div class="lineright"><span class="right"><span id="hex_text"></span><img id="hex_icon" class="icon" src="../img/blank.png" alt="" /></span></div>
			</div>
			<div class="line">
				<div class="lineleft">Merge with bootloader</div>
				<div class="lineright"><span class="right"><span id="merge_text"></span><img id="merge_icon" class="icon" src="../img/blank.png" alt="" /></span></div>
			</div>
			<div class="line">
				<div class="lineleft">Upload to ATMega32u4</div>
				<div class="lineright"><span class="right"><span id="upload_text"></span><img id="upload_icon" class="icon" src="../img/blank.png" alt="" /></span></div>
			</div>					
          </div>
        </div>
      </div>
    </div>
</div>

</body>
</html>