<?php

include('config/general.php');

include(_CLASSES.'connection.php');
include_once(_FUNCTION.'general.php');

$page = isset($_GET['source']) ? $_GET['source'] : '';

if($page != '' && file_exists('ajax_service/'.$page.'_ajax.php')){
	include 'ajax_service/'.$page.'_ajax.php';
}else{
	echo 'ไม่มีหน้าเว็บที่ระบุ '. 'ajax_service/'.$page.'_ajax.php';
}
//END OF FILE
?>