<style>
	#question td{ text-align : center;}
</style>
<h2>รายงานแบบสอบถาม กับการแสดงคำตอบแบบตัวเลือกด้วย Radio Button</h2>

<?php
$form_id = 3;

$db = new dbConnect();

$sql = "SELECT * FROM tb_question_form WHERE qfrm_id = $form_id";
$qry = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($qry);
echo '<h3>',$row['qfrm_title'],'</h3>';
?>
<table id="question" border="1">
	<thead>
		<tr>
			<th>ลำดับ</th>
			<th width="300">รายการ</th>
			<th width="70">ดีมาก</th>
			<th width="70">ดี</th>
			<th width="70">พอใช้</th>
			<th width="70">น้อย</th>
			<th width="70">น้อยที่สุด</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$no=0;
	$sql = "SELECT * FROM  `tb_question_list` 
			INNER JOIN tb_question_answer ON `tb_question_list`.qtn_id = tb_question_answer.ans_qtn_ref
			WHERE qtn_form_id = $form_id ";
	$qry = mysql_query($sql) or die(mysql_error());
	while($row = mysql_fetch_assoc($qry)){
		$no++;
		$title = $row['qtn_title'];
		$id = $row['qtn_id'];
		$check1="";
		$check2="";
		$check3="";
		$check4="";
		$check5="";
		if($row['ans_qtn_value']==5){
			$check1 = "checked=checked";
		}elseif($row['ans_qtn_value']==4){
			$check2 = "checked=checked";
		}elseif($row['ans_qtn_value']==3){
			$check3 = "checked=checked";
		}elseif($row['ans_qtn_value']==2){
			$check4 = "checked=checked";
		}elseif($row['ans_qtn_value']==1){
			$check5 = "checked=checked";
		}
	echo <<<DOC
		<tr>
			<td>$no</td>
			<td>$title</td>
			<td><input type="radio" name="choice$id" $check1/></td>
			<td><input type="radio" name="choice$id" $check2 /></td>
			<td><input type="radio" name="choice$id" $check3 /></td>
			<td><input type="radio" name="choice$id" $check4 /></td>
			<td><input type="radio" name="choice$id" $check5 /></td>
		</tr>
DOC;
	}
	?>
	
	<!--
		<tr>
			<td>2</td>
			<td>รายการที่ 2</td>
			<td><input type="radio" name="choice2" /></td>
			<td><input type="radio" name="choice2" /></td>
			<td><input type="radio" name="choice2" /></td>
			<td><input type="radio" name="choice2" /></td>
			<td><input type="radio" name="choice2" /></td>
		</tr>
		<tr>
			<td>3</td>
			<td>รายการที่ 3</td>
			<td><input type="radio" name="choice3"  /></td>
			<td><input type="radio" name="choice3"  /></td>
			<td><input type="radio" name="choice3"  /></td>
			<td><input type="radio" name="choice3"  /></td>
			<td><input type="radio" name="choice3"  /></td>
		</tr>
		<tr>
			<td>4</td>
			<td>รายการที่ 4</td>
			<td><input type="radio" name="choice4"  /></td>
			<td><input type="radio" name="choice4"  /></td>
			<td><input type="radio" name="choice4"  /></td>
			<td><input type="radio" name="choice4"  /></td>
			<td><input type="radio" name="choice4"  /></td>
		</tr>
		<tr>
			<td>5</td>
			<td>รายการที่ 5</td>
			<td><input type="radio"  name="choice5" /></td>
			<td><input type="radio"  name="choice5" /></td>
			<td><input type="radio"  name="choice5" /></td>
			<td><input type="radio"  name="choice5" /></td>
			<td><input type="radio"  name="choice5" /></td>
		</tr>
	-->
	</tbody>
</table>


