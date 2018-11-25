<?php   if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style>
#description1, #description2, #description3, #description4{
	background-color: #F8F8F8;
    min-height: 200px;
}
</style>
<h2>MySQL การใช้คำสั่ง SUM(), IF() ในการ SELECT ข้อมูล</h2>
<div id="nav">
	<a href="javascript:void(0);" onclick="display(0);loadData(0)">ข้อมูลทั้งหมด</a> |
	<a href="javascript:void(0);" onclick="display(1)">เรียกข้อมูลแบบที่ 1</a> |
	<a href="javascript:void(0);" onclick="display(2)">เรียกข้อมูลแบบที่ 2</a> |
	<a href="javascript:void(0);" onclick="display(3)">เรียกข้อมูลแบบที่ 3</a> |
	<a href="javascript:void(0);" onclick="display(4)">เรียกข้อมูลแบบที่ 4</a>
	<br/><br/>
</div>
<div id="description1"><img src="images/article/case1.png"/></div>
<div id="description2"><img src="images/article/case2.png"/></div>
<div id="description3"><img src="images/article/case3.png"/></div>
<div id="description4"><img src="images/article/case4.png"/></div>
<div id="nav">
	<input id="btn1" type="button" value="เรียกดูรายงาน" onclick="loadData(1)"/>
	<input id="btn2" type="button" value="เรียกดูรายงาน" onclick="loadData(2)"/>
	<input id="btn3" type="button" value="เรียกดูรายงาน" onclick="loadData(3)"/>
	<input id="btn4" type="button" value="เรียกดูรายงาน" onclick="loadData(4)"/>
</div>
<div id="main">

</div>
<br/>
<table border="1" id="tb_memexpr_rpt">
	<tbody><tr>
		<th>ลำดับ</th>
		<th>ชื่อสาขา</th>
		<th>จำนวนสมาชิกทั้งหมด</th>
		<th>สถานะปกติ</th>
		<th>สถานะหมดอายุ</th>
	</tr>
	
	<tr>
		<td>1</td>
		<td>สี่แยกแม่กรณ์</td>
		<td>4</td>
		<td>2</td>
		<td>2</td>
	</tr>
	
	<tr>
		<td>2</td>
		<td>ตลาดบ้านดู่</td>
		<td>3</td>
		<td>2</td>
		<td>1</td>
	</tr>
	
	<tr>
		<td>3</td>
		<td>เชียงราย</td>
		<td>3</td>
		<td>1</td>
		<td>2</td>
	</tr>
	
	<tr>
		<td>4</td>
		<td>นางแล</td>
		<td>2</td>
		<td>2</td>
		<td>0</td>
	</tr>
	
</tbody></table>


<address>
<br/>ที่มา : <a href="http://www.sunzan-design.com">http://www.sunzan-design.com</a>
</address>

<!-- <script type='text/javascript' src="js/jsParser.js"></script> -->
<script type='text/javascript'>
	/* URL */
	var ajaxURL = 'ajax_service.php?source=member_expire_rpt';

	/* Load Templates */
	var tplReport = loadContent('member_rpt/tpl_member_expire_rpt.php');
	var tplAllData = loadContent('member_rpt/tpl_member_expire_all.php');
	
	/*-------- loadData ----------*/
	function loadData(pCase){
		var pData = "action=case" + pCase;
		var pTemplate = tplReport;
		if(pCase == 0) pTemplate = tplAllData;
		$.ajax({
			dataType: "json",
			url: ajaxURL,
			data: pData,
			success: function(return_data){
				$('#main').html(parseHtml(pTemplate, return_data)).show();
			}
		});
	}
	
	loadData(0);
	
	function display(pElement){
		$('#btn1, #btn2, #btn3, #btn4').hide();
		$('#description1, #description2, #description3, #description4').hide();
		if(pElement){
			$('#btn'+pElement).fadeIn();
			$('#description'+pElement).fadeIn();
		}
		$('#main').html('').hide();
	}
	display(0);
</script>
