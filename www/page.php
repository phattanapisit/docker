<?php
	$page = isset($_GET['page']) ? $_GET['page'] : '';

	$page = (isset($_GET['page']) && $page !== '') ? 'pages/'.$_GET['page'].'.php' : 'pages/home.php';
	if(file_exists($page)){
		include($page);
	}else{
		echo '<p align="center" style="color:blue">ไม่พบหน้าเว็บที่ระบุครับ</p>';
	}

?>