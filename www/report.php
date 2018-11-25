<?php 
include('config/general.php');

include(_CLASSES.'connection.php');
include(_FUNCTION.'general.php');

require_once(_LIBRARIES.'tcpdf/config/lang/eng.php');
require(_LIBRARIES.'tcpdf/tcpdf.php');

$reportName = isset($_GET['rpt']) ? $_GET['rpt'] : '';
if($reportName != ''){
	$reportFile = _REPORT.$reportName.'_report.php';
	if(file_exists($reportFile)){
		include($reportFile);
	}else{
		header('Content-Type:text/html; charset=UTF-8');
		echo '<p align="center" style="color:blue">ไม่พบไฟล์รายงานที่ต้องการ</p>';
	}
	
}else{
	header('Content-Type:text/html; charset=UTF-8');
	echo '<H3 align="center" style="color:blue">การเข้าถึงหน้าเว็บไม่ถูกต้อง</H3>';
}

?>