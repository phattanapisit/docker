<?php
include_once('classes/connection.php');

/***** FUNCTION DEFINED  *****/
function search(){
	$db = new dbConnect();
	$search_key = isset($_GET['term']) ? $_GET['term'] : '';
	$no = 0;
	$data = array();
	$sql = "SELECT mbr_code, mbr_name FROM `tb_member` WHERE mbr_name LIKE '%$search_key%' ";  //-- ข้อมูลสาขาทั้งหมด
	$qry = mysql_query($sql) or die( $db->showError('',__FILE__,__LINE__) );
	while($row = mysql_fetch_assoc($qry)){
		$data[] = array('id'=>$row['mbr_code'], 'value'=>$row['mbr_name']);
	}
	echo json_encode($data);
}

function query(){
	$db = new dbConnect();//เชื่อมต่อฐานข้อมูล
	$data = array();
	$sql = "SELECT mbr_code, mbr_name FROM `tb_member` WHERE mbr_status > 0 ";  //-- ข้อมูลสมาชิกที่ใช้งาน
	$qry = mysql_query($sql) or die( $db->showError('',__FILE__,__LINE__) );
	while($row = mysql_fetch_assoc($qry)){
		$data[] = array('value'=>$row['mbr_code'], 'label'=>$row['mbr_name']);
	}
	echo json_encode($data);
}
//-- END DEFINE FUNCTION


//***** Call Function *****//
$action = isset($_POST['action']) ? $_POST['action'] : '';
if($action == '') $action = isset($_GET['action']) ? $_GET['action'] : '';
switch( $action ){
	case 'search':
		search();
		break;
	case 'query':
		query();
		break;	
}
//-- END Call Function

?>