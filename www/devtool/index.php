<!DOCTYPE html>
<html lang="th"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>พัฒนาทักษะการเขียนโปรแกรม PHP MySQL | แบ่งปันบทความ ฝึกฝนทักษะ เพื่อก้าวสู่อาชีพโปรแกรมเมอร์</title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="stylesheet" type="text/css" media="all" href="devtool_files/style.css">
<link rel="pingback" href="http://phpclass.pusku.com/xmlrpc.php">
<link rel="alternate" type="application/rss+xml" title="พัฒนาทักษะการเขียนโปรแกรม PHP MySQL » Feed" href="http://phpclass.pusku.com/feed/">
<link rel="alternate" type="application/rss+xml" title="พัฒนาทักษะการเขียนโปรแกรม PHP MySQL » ความเห็น Feed" href="http://phpclass.pusku.com/comments/feed/">
<link rel="stylesheet" id="admin-bar-css" href="devtool_files/admin-bar.css" type="text/css" media="all">
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://phpclass.pusku.com/xmlrpc.php?rsd">
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://phpclass.pusku.com/wp-includes/wlwmanifest.xml"> 
<meta name="generator" content="WordPress 3.5.1">
<meta name="stats-in-th" content="8654" />
<style type="text/css" media="print">#wpadminbar { display:none; }</style>
<style type="text/css" media="screen">
	html { margin-top: 28px !important; }
	* html body { margin-top: 28px !important; }
</style>
<style type="text/css"> 
	#tb_source_code td.num { 
	float: left; 
	color: gray; 
	font-size: 13px;    
	font-family: monospace; 
	text-align: right; 
	margin-right: 6pt; 
	padding-right: 6pt; 
	border-right: 1px solid gray;} 

	body {margin: 0px; margin-left: 5px;} 
	td {vertical-align: top;} 
	code {white-space: nowrap;} 
	#tb_source_code td.num > br {
		line-height: 26.49px;
	}
	#tb_source_code td span span {
		line-height: 26px;
	}
</style>
<!--[if IE]>
	<style type="text/css">
	#tb_source_code td span span {
		line-height: 26.45px;
	}
	</style>
<![endif]-->
<?php
function chkBrowser($nameBroser){
	return preg_match("/".$nameBroser."/",$_SERVER['HTTP_USER_AGENT']);
}
?>
<?php
if(chkBrowser("Chrome")==1){
	echo '<style type="text/css">
	#tb_source_code td span span {
		line-height: 25px;
	}
	</style>';
}
?>

</head>

<body class="home blog logged-in admin-bar  customize-support">
<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="masthead">
			<div id="branding" role="banner">
				<h1 id="site-title">
					<span>
						<a href="http://www.sunzan-design.com/" title="พัฒนาทักษะการเขียนโปรแกรม PHP MySQL" rel="home">พัฒนาทักษะการเขียนโปรแกรม PHP MySQL</a>
					</span>
				</h1>
				<div id="site-description">แบ่งปันบทความ ฝึกฝนทักษะ เพื่อก้าวสู่อาชีพโปรแกรมเมอร์</div>
					<img src="devtool_files/path.jpg" alt="" height="198" width="940">
				</div><!-- #branding -->

			<div id="access" role="navigation">
				<div class="menu">
					<ul>
						<li class="current_page_item"><a href="http://www.sunzan-design.com/" title="หน้าแรก">Home</a></li>
						<li class="current_page_item"><a href="http://www.sunzan-design.com/search/label/PHP%20%E0%B9%80%E0%B8%9A%E0%B8%B7%E0%B9%89%E0%B8%AD%E0%B8%87%E0%B8%95%E0%B9%89%E0%B8%99" title="เรียนรู้การเขียนโปรแกรม PHP">PHP Basic</a></li>
						<li class="current_page_item"><a href="http://www.sunzan-design.com/search/label/%E0%B9%81%E0%B8%99%E0%B8%B0%E0%B8%99%E0%B8%B3%E0%B8%84%E0%B8%B3%E0%B8%AA%E0%B8%B1%E0%B9%88%E0%B8%87%20%28PHP%20Function%29" title="แนะนำคำสั่งน่าใช้งาน">PHP Function</a></li>
						<li class="current_page_item"><a href="http://www.sunzan-design.com/search/label/%E0%B8%AB%E0%B9%89%E0%B8%AD%E0%B8%87%E0%B8%9B%E0%B8%8F%E0%B8%B4%E0%B8%9A%E0%B8%B1%E0%B8%95%E0%B8%B4%E0%B8%81%E0%B8%B2%E0%B8%A3%20%28PHP%20Labs%29" title="ห้องปฏิบัติการ เขียนโปรแกรม php">PHP Labs</a></li>
						<li class="current_page_item"><a href="http://www.sunzan-design.com/search/label/%E0%B8%81%E0%B8%A3%E0%B8%93%E0%B8%B5%E0%B8%A8%E0%B8%B6%E0%B8%81%E0%B8%A9%E0%B8%B2%20%28Case%20Studies%29" title="กรณีศึกษา การเขียนโปรแกรม PHP">Case Studies</a></li>

					</ul>
				</div>
			</div><!-- #access -->
		</div><!-- #masthead -->
	</div><!-- #header -->

	<div id="main">

		<div id="container">
			<div id="content" role="main" style="width:100%">
				<h2><font color="gray">PHP syntax highlight</font></h2>
				<form name="main_form" id="main_form" action="" method="POST" enctype="multipart/form-data">
					<table style="width: 540px; margin-left: auto; margin-right: auto; border-collapse: collapse;">
						<tr>
							<td><input type="file" name="source_file" /></td>
							<td><input type="submit" value="Preview" /></td>
						</tr>
					</table>
				</form>
				
				
				
				<div id="post-0" class="post">
				
				<?php if(isset($_FILES['source_file'])): 
				
					$inputFileName 	= $_FILES["source_file"]["tmp_name"];

					echo '<br/><h3 style="float:left"><i><a name="view_source"></a>[Source Code]<i></h3>';
					echo '<p style="float:right"><a href="#top" style="text-decoration: none;">[ <span style="color:orange">กลับสู่ด้านบน</span> ]</a>  </p>';
					echo '<div style="clear:both"></div>';
					function highlight_num($file) 
					{ 
						$content = highlight_file($file, true); 

						$cLine = count(file($file));
						$lines = implode(range(1, $cLine), '<br/>'); 

						echo "<table id='tb_source_code'><tr><td class=\"num\">\n$lines\n</td><td>\n$content\n</td></tr></table>"; 
					} 
					highlight_num($inputFileName); 

				?>
				<?php else: ?>
				
					<?php
						$page = isset($_GET['page']) ? 'examples/'.$_GET['page'].'.php' : '';
						$pageTitle = isset($_GET['title']) ? $_GET['title'] : '';
					?>
					<a name="top"></a>
					<h1 class="entry-title">ซอร์สโค๊ด และตัวอย่างการทำงาน  <?php echo ($pageTitle) ? " :: " . $pageTitle : '';?> &nbsp;&nbsp; <?php echo (file_exists($page)) ? '<code><i><a href="#view_source">[ <span style="color:orange">ดูซอร์สโค๊ด</span> ]</a></i></code>' : ''?></h1>
					<div class="entry-content" style="padding-right:20px;">
						<p>
							<?php 
								
								if(file_exists($page)){
									include($page);

									echo '<br/><h3 style="float:left"><i><a name="view_source"></a>[Source Code]<i></h3>';
									echo '<p style="float:right"><a href="#top" style="text-decoration: none;">[ <span style="color:orange">กลับสู่ด้านบน</span> ]</a>  </p>';
									echo '<div style="clear:both"></div>';
									function highlight_num($file) 
									{ 
										$content = highlight_file($file, true); 

										$cLine = count(file($file));
										$lines = implode(range(1, $cLine), '<br/>'); 

										echo "<table id='tb_source_code'><tr><td class=\"num\">\n$lines\n</td><td>\n$content\n</td></tr></table>"; 
									} 
									highlight_num($page); 

								}else{
									//echo '<p style="color:blue">ไม่พบหน้าเว็บที่ระบุครับ</p>';
									include("home.php");
								}
							?>
						</p>
						<pre><a href="#top" style="text-decoration: none;">[ <span style="color:orange">กลับสู่ด้านบน</span> ]</a></pre>
					</div><!-- .entry-content -->
					
				<?php endif; ?>
					
				</div><!-- #post-0 -->
				
			</div><!-- #content -->
		</div><!-- #container -->


	</div><!-- #main -->

	<div id="footer" role="contentinfo">
		<div id="colophon">

			<div id="site-info">
				<a href="http://www.sunzan-design.com/" title="พัฒนาทักษะการเขียนโปรแกรม PHP MySQL" rel="home">
					พัฒนาทักษะการเขียนโปรแกรม PHP MySQL				</a>
			</div><!-- #site-info -->

			<div id="site-generator">
				ตัวอย่างซอร์สโค๊ด ::   naizan28@gmail.com
				<script type="text/javascript" language="javascript1.1" src="http://tracker.stats.in.th/tracker.php?sid=51920"></script><noscript><a target="_blank" href="http://www.stats.in.th/">www.Stats.in.th</a></noscript>
			</div><!-- #site-generator -->

		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrapper -->

</body>
</html>