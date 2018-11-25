<?php
/**
 * อ่านไฟล์ในโฟลเดอร์ที่กำหนด เพื่อเก็บไว้ใช้โหลด js css
 * @param String $dirName
 * @param String $ext
 * @return Array ที่เก็บชื่อไฟล์ทั้งหมดในโฟลเดอร์
 */
function loadAllFile($dirName, $ext = '')
{
	$file = array();
	$st = strrpos($dirName, "/");
	$dHandle  = opendir($dirName);
	while (false !== ($filename = readdir($dHandle)))
	{
		if($filename == "." || $filename == "..")continue;
		if($ext != ''){
			$info = pathinfo($filename);
			$eArr = explode(',', $ext);
			foreach ($eArr as $extA){
				$extArr[] = $extA;
				$extArr[] = strtoupper($extA);
			}
			//echo '<br>'.$info["extension"]. ' != '.print_r($extArr,true);
			if( ! in_array($info["extension"], $extArr) ) continue;
		}
		if(is_file($dirName.$filename))
		{
			$file[] = $filename;
		}
	}
	if(!empty($file))natcasesort($file);
	return $file;
}


function base_url(){
	$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	$dir = pathinfo($_SERVER['PHP_SELF']);
	$dir = explode('/', $dir['dirname']);
	$dirname = '';
	$a=0;
	foreach($dir as $name){
		if($name != '' && $a < 2){
			$dirname .= (($dirname != '') ? '/' : '').$name;
			$a++;
		}
	}
	return $protocol . "://" . $_SERVER['HTTP_HOST'] .'/'. $dirname;
}

function setDateFormat($date){//สร้างรูปแบบของวันที่ yyyy-mm-dd
	//if(ereg("([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})",$date,$arr) || ereg("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})",$date,$arr) ){
	if(preg_match("/^([0-9]{1,2})\-([0-9]{1,2})\-([0-9]{4})$/",$date,$arr) || preg_match("/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/",$date,$arr) ){
		//ถ้าเป็น xx-xx-yyyy หรือ xx/xx/yyyy
		$y = $arr[3];
		$m = sprintf("%02d",$arr[2]);
		$d = sprintf("%02d",$arr[1]);
	//}else if(ereg("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})",$date,$arr) || ereg("([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})",$date,$arr)){
		}else if(preg_match("/^([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2})$/",$date,$arr) || preg_match("/^([0-9]{4})\/([0-9]{1,2})\/([0-9]{1,2})$/",$date,$arr)){
		//ถ้าเป็น yyyy-xx-xx หรือ yyyy/xx/xx
		$y = $arr[1];
		$m = sprintf("%02d",$arr[2]);
		$d = sprintf("%02d",$arr[3]);
	}
	if(($y!="" && $m != "" && $d != "") and ($y!= '0000' && $m != '00' && $d != '00')){
		return $y."-".$m."-".$d; //คืนค่า ปี-เดือน-วัน
	}
}

function toEngDate($date, $case = '')
{
	$strDate = setDateFormat($date);//yyyy-mm-dd
	$arrDate = explode("-", $strDate);
	$arrDate[0] = $arrDate[0] - 543;	//เป็นปี ค.ศ.
	$separator = "-";
	return $arrDate[0].$separator.$arrDate[1].$separator.$arrDate[2];
}

function toThaiDate($date, $case = '', $setThaYear = false)
{
	$strDate = setDateFormat($date);//yyyy-mm-dd
	$arrDate = explode("-", $strDate);
	if($setThaYear == true) $arrDate[0] = $arrDate[0] + 543;	//ถ้าส่งมาเป็นปี ค.ศ. ให้ส่งค่าที่ 3 มาเป็น true ด้วย
	$separator = " ";
	$m = (int)$arrDate[1];
	switch ($case){
		case 'short':
			$month = array('', 'ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.', 'พ.ย.','ธ.ค.');
			break;
		case 'full':
			$month = array('', 'มกราคม','กุมภาพันธ์.','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม', 'พฤศจิกายน','ธันวาคม');
			break;
		default:
			$month = array('', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
			$separator = $case;
			break;
	}
	return $arrDate[2].$separator.$month[$m].$separator.$arrDate[0];
}

function getTimeDate($date, $case = 1){
	$dateA = explode(' ', $date);
	if(count($dateA) > 1){
		$arrD = explode(':', $dateA[1]);
	}else{
		$arrD = explode(':', $dateA[0]);
	}
	if($arrD[2] == '') $arrD[2] = '00';
	switch($case){
		case 1: $time = $arrD[0].':'.$arrD[1].':'.$arrD[2];break;
		case 2: $time = $arrD[0].':'.$arrD[1]; break;
	}
	return $time;
}


function setPriceFormat($price, $null = ''){
	$price = number_format($price, 2);
	return $price;
}

function setDecimal($price){
	$price = str_replace(",", "", $price);
	$exp = explode('.', (string)$price );
	if(!$exp[0]) $exp[0] = '0';
	if(!$exp[1]) $exp[1] = '00';
	$n = $exp[0];
	unset($exp[0]);
	$d = implode('', $exp);
	return $n.'.'.$d;
}

//หากกำหนดสิทธิ์ตอนที่ออนไลน์อยู่ สิทธิ์นั้นจะยังไม่เปลี่ยน ต้องล็อกอินเข้าใช้งานใหม่อีกครั้ง
function checkPagePermission($pageName){
	$filename = _CONFIG.'permission_'.$pageName.'.php';
	if(file_exists($filename)){
		if(isset($_SESSION[$pageName.'_permission'])){
			$_SESSION['page_permission'] = $_SESSION[$pageName.'_permission'];
			return $_SESSION[$pageName.'_permission'];//เช็กครั้งเดียว
		}
		include $filename;
		$check = false;
		if(!empty($ALLOWED_LEVEL) && in_array($_SESSION['gfmis_user_level'], $ALLOWED_LEVEL)){
			$check = 'R';
		}
		//CHECK EDIT PERMISSION
		if((!empty($ALLOWED_USER['EDIT']) && in_array($_SESSION['gfmis_user'], $ALLOWED_USER['EDIT'])) 
			|| (!empty($ALLOWED_USER['READ']) && in_array($_SESSION['gfmis_user'], $ALLOWED_USER['READ'])) ){
			$ALLOWED_USER['EDIT'] = isset($ALLOWED_USER['EDIT']) ? $ALLOWED_USER['EDIT'] : array();
			$check = in_array($_SESSION['gfmis_user'], $ALLOWED_USER['EDIT']) ? 'RW' : 'R';
		}
		$_SESSION[$pageName.'_permission'] = $check;
		$_SESSION['page_permission'] = $check;
		return $check;
	}else{
		echo 'ไม่พบไฟล์คอนฟิก';
	}
}

//END OF FILE
?>