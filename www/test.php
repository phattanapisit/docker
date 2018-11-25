<?php
include('config/general.php');
include(_CLASSES.'connection.php');
include_once(_FUNCTION.'general.php');

//$_SESSION['username'] = ""
unset($_SESSION['username']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="noindex, nofollow">
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<title>PHP coding & Design : ซอร์สโค๊ดตัวอย่าง : www.sunzan-design.com</title>
	<link rel="shortcut icon" href="images/favicon.jpg" />

	<link rel="stylesheet" href="css/cssmenu.css" type="text/css">
	<link rel="stylesheet" href="css/button.css" type="text/css">
	<link rel="stylesheet" href="css/theme.css" type="text/css" />
	<link rel="stylesheet" href="css/menu.css" type="text/css" />
	<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.1.custom.css" type="text/css" />
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.1.custom.min.js"></script>
	<script type="text/javascript" src="js/general.js"></script>
	<script type='text/javascript' src="js/jsParser.js"></script>
	<style>
		a {color : color:#0085E3;}
		a:hover{color:#5ADD00!important;}
		a:visited{color:#73C2F9;}
	</style>
</head>
<body>
<div id="div_header">
	<div id="Header1">
		<div id="header-inner">
			<div class="titlewrapper">
				<h1 class="title">
					PHP coding &amp; Design
				</h1>
				</div>
				<div class="descriptionwrapper">
				<p class="description">
				<span>
				ฝึกเขียนโปรแกรมใช้เองง่ายๆ ด้วยภาษา PHP, MySQL, HTML, JavaScript, jQuery, CSS
				</span>
				</p>
				<h1 style="color:#fff;font-size:16px">WWW.SUNZAN-DESIGN.COM</h1>
			</div>
		</div>
	</div>
</div>
<div id="bg_center">
<table id="tb_main" border="0" cellpadding="0" cellspacing="0">
	<tr class="bg">
		<td id="td_center" valign="top">

			<h2>การตรวจสอบตัวแปรด้วยฟังก์ชั่น <a href="?page=isset_test">isset()</a></h2>
						<div id="div_content">
							<?php 

								$page = isset($_GET['page']) ? $_GET['page'] : '';
								$page = (isset($_GET['page']) && $page !== '') ? 'test/'.$_GET['page'].'.php' : 'pages/home.php';
								if(file_exists($page)){
									include($page);
								}else{
									echo '<p align="center" style="color:blue">ไม่พบหน้าเว็บที่ระบุครับ</p>';
								}
								
							?>
						</div>

		</td>
	</tr>
	
</table>
</div>
	<div id="div_footer">		
		<div><a href="http://www.sunzan-design.com" target="_blank">PHP coding & Design :: http://www.sunzan-design.com</a></div>
		<div>ฝึกเขียนโปรแกรมใช้เองง่ายๆ ด้วยภาษา PHP, MySQL, HTML, JavaScript, jQuery, CSS</div>
	</div>
<div id="dialog-message" title="">
</div>
</body>
</html>