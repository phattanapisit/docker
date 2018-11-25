<?php
include_once('classes/connection.php');

/***** FUNCTION DEFINED  *****/
function getQuestionnaireList()
{
	$db = new dbConnect();
	
	$cond = "";
	if(isset($_GET['keyword']) && $_GET['keyword'] != ''){
		$cond .= " AND qtn_title LIKE '%$_GET[keyword]%' ";
	}
	
	$no = 0;
	$data = array();
	$sql = "SELECT * FROM `tb_questionnaire` WHERE qtn_active = 1 $cond ";
	$qry = mysql_query($sql) or die( $db->showError('',__FILE__,__LINE__) );
	while($row = mysql_fetch_assoc($qry)){
		$no++;
		$status = ($row['qtn_status'] == 1 ? 'ใช้งาน' : 'ยกเลิก');
		$data[] = array('no' => $no, 'title' => $row['qtn_title'], 'status' => $status);
	}
	$no_result_display = '';
	if($no > 0) $no_result_display = 'display:none';
	$json = array(
				'data_list' => $data,
				'no_result_display' => $no_result_display
			);
	echo json_encode($json);

}
//-- END DEFINE FUNCTION


//***** Call Function *****//
$action = isset($_POST['action']) ? $_POST['action'] : '';
if($action == '') $action = isset($_GET['action']) ? $_GET['action'] : '';
switch( $action ){
	case 'get_list':
		getQuestionnaireList();
		break;
}
//-- END Call Function

?>