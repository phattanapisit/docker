<?php
include('config/general.php');
include(_CLASSES.'connection.php');
include_once(_FUNCTION.'general.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
		#cssmenu li.active a:link, #cssmenu li.active a:visited{
			color : #0CCB77;
			font-weight : bold;
		}
		#main{
			min-height: 220px;
		}
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
				
			</div>
		</div>
		<h1 style="color:#fff;font-size:20px;float:right;margin-top:55px">WWW.SUNZAN-DESIGN.COM</h1>
	</div>
</div>
<div id="bg_center">
<table id="tb_main" border="0" cellpadding="0" cellspacing="0">
	<tr class="bg">
		<td id="td_center" valign="top">
			<table id="tb_content" width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td id="td_content_left" valign="top">
						<div id="cssmenu">
							<ul><b>Main</b>
								<li><a href='index.php'><span>หน้าหลัก</span></a></li>
							</ul>
							<ul><b>PHP</b>
								<li><a href='index.php?page=calendar'><span>ตัวอย่างการสร้างปฏิทิน PHP</span></a></li>
								<li><a href='index.php?page=calendar_optimize'><span>ปฏิทิน PHP (Optimize with JavaScript)</span></a></li>
								<li><a href='index.php?page=questionnaire'><span>ตัวอย่างการสร้างแบบสอบถามด้วย PHP</span></a></li>
								<li><a href='index.php?page=member_expire_rpt'><span>MySQL การ SELECT แบบใช้ IF</span></a></li>
							</ul>
							<ul><b>JavaScript & jQuery</b>
								<li><a href='index.php?page=js_toggle_data'><span>JavaScript เพิ่ม/ลบ ข้อมูลใน Array</span></a></li>
								<li><a href='index.php?page=option_list'><span>เปลี่ยนข้อมูล drop-down list ด้วยการรับส่งข้อมูลแบบ Ajax</span></a></li>
								<li><a href='index.php?page=form_checked'><span>รายงานแบบสอบถาม กับการแสดงคำตอบแบบตัวเลือกด้วย Radio Button</span></a></li>
							</ul>
							<ul><b>Example</b>
								<li class="active"><a href='index.php?page=jquery_autocomplete'><span>ระบบ Autocomplete ด้วย jQuery</span></a></li>
								
							</ul>
						</div>
						<div style="text-align:center; padding : 10px;">
						<a href="http://www.sunzan-design.com/p/download-php-source-code.html#all_source" style="text-decoration: none; color: #15AEFF">
							<img align="absmiddle" src="<?php echo _templates;?>images/download.gif"/><b> ดาวน์โหลดซอร์สโค๊ดทั้งหมดนี้ http://www.sunzan-design.com</b></a>
						</div>
					</td>
					<td id="td_content_center" valign="top">
						<div id="div_content">
							<?php 
								include('page.php');
							?>
						</div>
					</td>
				</tr>			
			</table>
		</td>
	</tr>
	
</table>
</div>
	<div id="div_footer">		
		<h3><a href="http://www.sunzan-design.com" target="_blank">PHP coding & Design : http://www.sunzan-deisgn.com</a></h3>
		<div>ฝึกเขียนโปรแกรมใช้เองง่ายๆ ด้วยภาษา PHP, MySQL, HTML, JavaScript, jQuery, CSS</div>
	</div>
<div id="dialog-message" title="">
</div>
</body>
</html>