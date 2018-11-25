<?php
error_reporting(E_ALL ^ E_NOTICE);

echo '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>สร้างตัวแปรรับค่า สำหรับ INSERT ลงฐานข้อมูล</title>
<style>
h3 font{font-size: 14px;}
#addForm label {
    color: #6D70FF;
    font-size: 14px;
    font-weight: bold;
}
</style>
</head>
<body>
';

$form = <<<DOC

<form method="post" action="$SERVER[PHP_SELF]" enctype="multipart/form-data" name="addForm" id="addForm">
<table border="0" align="center" cellpadding="2" cellspacing="1" bordercolor="#999900" width="100%">
	<tr><td><p style="color:#FE6F3B;font-size:20px;font-weight:bold;">สร้างตัวแปร และโค๊ด SQL สำหรับ INSERT</p></td></tr>
	<tr><td>
		<h3>สามารถ Copy ชื่อฟิลด์จากหัวตาราง มาวางในช่องรับข้อความได้เลย <br/><font style="color: #8F91F9">(ให้คลุมดำแล้วก๊อบมาทั้งหมายเหตุเลย จะทำการแยกชื่อฟิลด์อัตโนมัติ)</font></h3>
		
		รับข้อมูลจากตัวแปรแบบ  : 
		<input type='radio' name='type' id='type2' value='POST' checked='checked'> <label for='type2' style='cursor:pointer'>POST</label>
		<input type='radio' name='type' id='type1' value='GET'> <label for='type1' style='cursor:pointer'>GET</label><br>
		ตัวแยกข้อมูลในฟอร์มด้วย : 
		<input type='radio' name='split' id='split1' value='tab' checked='checked' onclick="other.disabled=true;"> <label for='split1' style='cursor:pointer'> TAB </label>
		<input type='radio' name='split' id='split2' value='space' onclick="other.disabled=true;"> <label for='split2' style='cursor:pointer'> Space </label>
		<input type='radio' name='split' id='split3' value='other' onclick="other.disabled=false;"><label for='split3' style='cursor:pointer'> ระบุ </label>
		<input type='text' name='other' id='other' onfocus="this.select();" disabled ><br>
		ระบุชื่อตาราง  :  <input type='text' name='table_name' id='table_name' />
	</td></tr>
	<tr><td><textarea name="text" id='text' style="width:98%;height:170px"> payment_id 	payment_customer_id 	payment_date 	payment_amount </textarea></td></tr>
	<tr><td><input type="submit" name="sent" value="     สร้างตัวแปร       "></td></tr>
</table>
</form>
DOC;
echo $form;

if($_POST['text']){
$string = $_POST['text'];
$type 	= $_POST['type'];
$split	= $_POST['split'];
$tableName = isset($_POST['table_name']) ? $_POST['table_name'] : '';
if($tableName == '') $tableName = 'myTableName';

if($split=="tab"){
	$split = "	";
}else if($split=="space"){
	$split = " ";
}else if($split=="other"){
	$split = $_POST['other'];
	if($split==""){
		$split = " ";
	}
}

$exp = explode($split,$string);
foreach ($exp as $val){
	$txt = trim($val);
	$arr = explode(" ",$txt);
	$txt = $arr[0];
	//if($txt && ereg("^[a-zA-Z0-9_]+$", $txt)){
	if($txt && preg_match('/^[a-zA-Z0-9_]+$/', $txt, $extension)){
		//echo $txt.",";
		$var .= '$'.$txt.' = $_'.$type.'["'.$txt.'"];'."\n";
		$new_string .= $sign.$txt;
		if($sign==""){$sign=",";}
	}
	if($val && $arr[0]){
		$comment = '';
		$comment = trim(str_replace($arr[0], '', trim($val)));
		if($comment){
			$comment = '//'.$comment;
		}
		$var2 .= "\t\t'".$arr[0]."'".' => \$this->input->post('."'".$arr[0]."'".'), '. $comment ."\n";
		$var3 .= "\t\t'".$arr[0]."'".' => $_POST['."'".$arr[0]."'".'], '. $comment ."\n";
	}
}

$var_value = "'$". str_replace(",","','$",$new_string)."'";

$sqlText  = '$sql  = "INSERT INTO '. $tableName ." \n";
$sqlText .= '$sql .= "('.$new_string.')";'."\n";
$sqlText .= '$sql .= "VALUES";'."\n";
$sqlText .= '$sql .= "('.$var_value.')";'."\n";
$sqlText .= '$result = mysql_query($sql) or die("เกิดข้อผิดพลาด :: ". mysql_error());'."\n";
$sqlText .= 'if($result){'."\n";
$sqlText .=	'	echo "บันทึกข้อมูลเรียบร้อย";'."\n";
$sqlText .=	'}'."\n";

$newText = $var."\n".$sqlText;
$newText = stripslashes($newText);


$newTextWithComment = "\t\$data = array(\n".$var2."\t);\n";
$newTextWithComment.= "\t\$qry = \$this->db->insert_string('$tableName', \$data);\n";
$newTextWithComment = stripslashes($newTextWithComment);

$newTextWithComment3 = "\t\$data = array(\n".$var3."\t);\n";
$newTextWithComment3 = stripslashes($newTextWithComment3);

echo "<br><table width=100%>
		<tr><td>
			<h3>คำสั่ง Insert เต็มรูปแบบ</h3>
			<textarea id='new' rows='19' style='width:100%' onclick='this.select();'>$newText</textarea>
		</td></tr>
		<tr><td>
			<h3>สร้างอาร์เรย์สำหรับฟังก์ชั่น CodeIgniter</h3>
			<textarea  rows='19' style='width:100%;' onclick='this.select();'>$newTextWithComment</textarea>
		</td></tr>
		<tr><td>
			<h3>สร้างอาร์เรย์สำหรับฟังก์ชั่นอื่นๆ </h3>
			<textarea  rows='19' style='width:100%;' onclick='this.select();'>$newTextWithComment3</textarea>
		</td></tr>
		</table>";

echo "<script type='text/javascript'>
		//main.scrollTo(0,500);
		document.getElementById('new').focus();
		document.getElementById('text').value='$string';
		
	  </script>";
}
echo '</body></html>';
?>