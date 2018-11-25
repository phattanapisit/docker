<?php   if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style type="text/css">
	.choice{
		background-color : #cccccc;
		padding : 15px 5px;
		margin : 5px;
		float : left;
		cursor : pointer;
		width : 80px;
		text-align : center;
		font-weight : bold;
	}
	.choice:hover{
		background-color : #A1E15E;
	}
</style>
<script type='text/javascript'>
	var choice = [];
	function toggleArrayData(xName){
		var my_position = choice.indexOf(xName);
		if(my_position < 0){
			choice.push(xName);
		}else{
			choice.splice(my_position ,1);
		}
		var xData = choice.join(", ");
		$('#my_choice').text(xData);//แสดงผลรายการที่เลือก
		$('#txt_data').val(xData);//เก็บไว้ส่งไปบันทึกลงฐานข้อมูล
	}	
</script>
<h2>ตัวอย่าง JavaScript การเพิ่มลดข้อมูลใน Array</h2>
<div id="main_js_toggle">
	<div id="js_toggle">
		<div class="choice" onclick="toggleArrayData('PHP');">PHP</div>
		<div class="choice" onclick="toggleArrayData('SQL');">SQL</div>
		<div class="choice" onclick="toggleArrayData('JavaScript');">JavaScript</div>
		<div class="choice" onclick="toggleArrayData('jQuery');">jQuery</div>
	</div>
	<div style="clear:both"></div>
	<br/>
	<div>
		<b>รายการที่เลือก :</b> <span id="my_choice">...</span>
	</div>
	<?php
	if(isset($_POST['txt_data']) && $_POST['txt_data'] != ''){
		$data = isset($_POST['txt_data']) ? $_POST['txt_data'] : '';
		$sql = "INSERT INTO my_table (fld_value) VALUES ('$data')";
		echo '<blockquote style="background-color: #E4FFE4;color: #008000;padding: 10px;">'. $sql .'</blockquote>';
	}
	?>
	<form method="POST" action="index.php?page=js_toggle_data">
		<input type="hidden" id="txt_data" name="txt_data" value="" />
		<br/><input type="submit" value="บันทึกข้อมูล" />
	</form>
</div>

<address>
<br/>ที่มา : <a href="http://www.sunzan-design.com">http://www.sunzan-design.com</a>
</address>
