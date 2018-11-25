<?php
include_once('classes/connection.php');

/***** FUNCTION DEFINED  *****/
function selectAndQuery(){
	$db = new dbConnect();
	
	$no = 0;
	$data = array();
	$sql = "SELECT * FROM `tb_comp_branch` ";  //-- ข้อมูลสาขาทั้งหมด
	$qry = mysql_query($sql) or die( $db->showError('',__FILE__,__LINE__) );
	while($row = mysql_fetch_assoc($qry)){
		$no++;
		
		$bch_id = $row['cbr_id'];
		$branch_name = $row['cbr_name'];
		
		//สถานะใช้งานปกติ
		$sql = "SELECT COUNT(*) AS active_qty FROM `tb_member` WHERE mbr_branch = $bch_id AND mbr_expire_date >= DATE(NOW()) ";
		$qry2 = mysql_query($sql) or die( $db->showError('',__FILE__,__LINE__) );
		$row2 = mysql_fetch_assoc($qry2);
		$active_qty = $row2['active_qty'];
		
		//สถานะหมดอายุ
		$sql = "SELECT COUNT(*) AS expire_qty FROM `tb_member` WHERE mbr_branch = $bch_id AND mbr_expire_date < DATE(NOW()) ";
		$qry2 = mysql_query($sql) or die( $db->showError('',__FILE__,__LINE__) );
		$row2 = mysql_fetch_assoc($qry2);
		$expire_qty = $row2['expire_qty'];

		$rs = array(
				'no' => $no, 
				'branch' => $branch_name, 
				'total' => $active_qty + $expire_qty,
				'active_qty' => $active_qty,
				'expire_qty' => $expire_qty,
			);
		$data[] = $rs;
	}
	$json = array(
				'list' => $data
			);
	echo json_encode($json);
}

function selectAndArray(){
	$db = new dbConnect();
	
	$no = 0;
	$data = array();
	$arr = array();
	$sql = "SELECT tb_comp_branch.cbr_name, tb_member.*
			FROM `tb_member`
			INNER JOIN `tb_comp_branch` ON tb_member.mbr_branch = tb_comp_branch.cbr_id";
	$qry = mysql_query($sql) or die( $db->showError('',__FILE__,__LINE__) );
	while($row = mysql_fetch_assoc($qry)){  //-- วนลูปแสดงข้อมูลทั้งหมด
		$active_qty  = 0;
		$expire_qty = 0;
		//-- วันที่มากกว่าหรือเท่ากับวันนี้=ใช้งานปกติ, ถ้าน้อยกว่า=หมดอายุ
		if($row['mbr_expire_date'] >= date('Y-m-d')){
			$active_qty = 1;
		}else{
			$expire_qty = 1;
		}
		//-- ตรวจสอบค่าเดิมของสาขานั้นๆ ถ้ามีให้เพิ่มเข้าไปด้วย
		if(isset($arr[$row['mbr_branch']]['active'])){
			$active_qty += $arr[$row['mbr_branch']]['active'];
		}
		if(isset($arr[$row['mbr_branch']]['expire'])){
			$expire_qty += $arr[$row['mbr_branch']]['expire'];
		}
		//-- เก็บข้อมูลไว้ในอาร์เรย์
		$arr[$row['mbr_branch']]['expire'] = $expire_qty; 
		$arr[$row['mbr_branch']]['active'] = $active_qty;
		$arr[$row['mbr_branch']]['name'] = $row['cbr_name'];
	}
	if(!empty($arr)){  //-- ถ้ามีข้อมูลให้วนลูปแสดงข้อมูลทั้งหมด
		foreach($arr as $rs){
			$no++;
			$rs = array(
				'no' => $no, 
				'branch' => $rs['name'], 
				'total' => $rs['active'] + $rs['expire'],
				'active_qty' => $rs['active'],
				'expire_qty' => $rs['expire'],
			);
			$data[] = $rs;
		}
	}
	$json = array(
				'list' => $data
			);
	echo json_encode($json);
}

function selectGroupArray(){
	$db = new dbConnect();
	
	$no = 0;
	$data = array();
	$arr = array();
	$sql = "SELECT tb_member.mbr_branch, tb_comp_branch.cbr_name, COUNT(*) AS qty, 
			IF(mbr_expire_date >= DATE(NOW()), 1, 0) AS exp_status
			FROM `tb_member`
			INNER JOIN `tb_comp_branch` ON tb_member.mbr_branch = tb_comp_branch.cbr_id
			GROUP BY mbr_branch, exp_status";
	$qry = mysql_query($sql) or die( $db->showError('',__FILE__,__LINE__) );
	while($row = mysql_fetch_assoc($qry)){
		$active_qty  = 0;
		$expire_qty = 0;
		//-- 1=ใช้งานปกติ, 0=หมดอายุ
		if($row['exp_status'] == 1){
			$active_qty = $row['qty'];
		}else{
			$expire_qty = $row['qty'];
		}
		//-- ตรวจสอบค่าเดิมของสาขานั้นๆ ถ้ามีให้เพิ่มเข้าไปด้วย
		if(isset($arr[$row['mbr_branch']]['active'])){
			$active_qty += $arr[$row['mbr_branch']]['active'];
		}
		if(isset($arr[$row['mbr_branch']]['expire'])){
			$expire_qty += $arr[$row['mbr_branch']]['expire'];
		}
		//-- เก็บข้อมูลไว้ในอาร์เรย์
		$arr[$row['mbr_branch']]['expire'] = $expire_qty; 
		$arr[$row['mbr_branch']]['active'] = $active_qty;
		$arr[$row['mbr_branch']]['name'] = $row['cbr_name'];
	}
	if(!empty($arr)){  //-- ถ้ามีข้อมูลให้วนลูปแสดงข้อมูลทั้งหมด
		foreach($arr as $rs){
			$no++;
			$rs = array(
				'no' => $no, 
				'branch' => $rs['name'], 
				'total' => $rs['active'] + $rs['expire'],
				'active_qty' => $rs['active'],
				'expire_qty' => $rs['expire'],
			);
			$data[] = $rs;
		}
	}
	$json = array(
				'list' => $data
			);
	echo json_encode($json);
}

function selectWithSUMIF()
{
	$db = new dbConnect();
	
	$no = 0;
	$data = array();
	$sql = "SELECT tb_comp_branch.cbr_name, 
			SUM(IF(mbr_expire_date >= DATE(NOW()), 1, 0)) AS active_qty,
			SUM(IF(mbr_expire_date < DATE(NOW()), 1, 0)) AS expire_qty
			FROM `tb_member`
			INNER JOIN `tb_comp_branch` ON tb_member.mbr_branch = tb_comp_branch.cbr_id
			GROUP BY mbr_branch";
	$qry = mysql_query($sql) or die( $db->showError('',__FILE__,__LINE__) );
	while($row = mysql_fetch_assoc($qry)){  //วนลูปแสดงข้อมูลทั้งหมด
		$no++;
		$rs = array(
					'no' => $no, 
					'branch' => $row['cbr_name'], 
					'total' => $row['active_qty'] + $row['expire_qty'],
					'active_qty' => $row['active_qty'],
					'expire_qty' => $row['expire_qty'],
				);
		$data[] = $rs;
	}
	$json = array(
				'list' => $data
			);
	echo json_encode($json);

}

function selectAll(){
	$db = new dbConnect();
	
	$no = 0;
	$data = array();
	$sql = "SELECT tb_comp_branch.cbr_name, tb_member.*
			FROM `tb_member`
			INNER JOIN `tb_comp_branch` ON tb_member.mbr_branch = tb_comp_branch.cbr_id";
	$qry = mysql_query($sql) or die( $db->showError('',__FILE__,__LINE__) );
	while($row = mysql_fetch_assoc($qry)){
		$no++;
		$status = ($row['mbr_expire_date'] >= date('Y-m-d')) ? 'ปกติ' : '<span style="color:red">หมดอายุ</span>';
		$rs = array(
					'no' => $no, 
					'code' => $row['mbr_code'],
					'branch' => $row['cbr_name'], 
					'name' => $row['mbr_name'],
					'expire_date' => $row['mbr_expire_date'],
					'status' => $status
				);
		$data[] = $rs;
	}
	$json = array(
				'list' => $data
			);
	echo json_encode($json);
}
//-- END DEFINE FUNCTION


//***** Call Function *****//
$action = isset($_POST['action']) ? $_POST['action'] : '';
if($action == '') $action = isset($_GET['action']) ? $_GET['action'] : '';
switch( $action ){
	case 'case0':
		selectAll();
		break;	
	case 'case1':
		selectAndQuery();
		break;	
	case 'case2':
		selectAndArray();
		break;	
	case 'case3':
		selectGroupArray();
		break;	
	case 'case4':
		selectWithSUMIF();
		break;
}
//-- END Call Function

?>