<?php   if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style type="text/css">
#code{
	background-color: #E4FFE4;
    color: #008000;
    padding: 10px;
}
</style>
<h2>แสดงข้อมูลรายละเอียดกิจกรรม</h2>
<div id="main">
	<div>จากตาราง : <?php echo $_GET['source'];?></div>
	<div>เลขอ้างอิง : <?php echo $_GET['ref'];?></div>
	<p>
	<blockquote id="code">SELECT * FROM <?php echo $_GET['source'];?> WHERE id = <?php echo $_GET['ref'];?></blockquote>
	</p>
</div>

