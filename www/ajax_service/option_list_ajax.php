<?php
include_once('classes/connection.php');

function loadDistrict(){
	$db = new dbConnect();
	
	$data = array();
	$sql = "SELECT dst_id AS district_id, dst_name AS district_name FROM `tb_district` ";  //-- ข้อมูลสาขาทั้งหมด
	$qry = mysql_query($sql) or die( $db->showError('',__FILE__,__LINE__) );
	while($row = mysql_fetch_assoc($qry)){
		$data[] = $row;
	}
	$json = array(
				'list' => $data
			);
	echo json_encode($json);
}

function loadPlace(){
	$db = new dbConnect();
	$dstId = $_GET['dst_id'];
	$data = array();
	$sql = "SELECT tvp_id AS place_id, tvp_name AS place_name FROM `tb_travel_place` WHERE `tvp_dst_id` = $dstId";  //-- ข้อมูลสาขาทั้งหมด
	$qry = mysql_query($sql) or die( $db->showError('',__FILE__,__LINE__) );
	while($row = mysql_fetch_assoc($qry)){
		$data[] = $row;
	}
	$json = array(
				'list' => $data
			);
	echo json_encode($json);
}

//***** Call Function *****//
$action = isset($_POST['action']) ? $_POST['action'] : '';
if($action == '') $action = isset($_GET['action']) ? $_GET['action'] : '';
switch( $action ){
	case 'load_district':
		loadDistrict();
		break;	
	case 'load_place':
		loadPlace();
		break;
}
//-- END Call Function

?>