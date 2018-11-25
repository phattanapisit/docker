<?php   if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="themes/example/css/calendar.css" type="text/css" />
<h2>ตัวอย่างการสร้างปฏิทินด้วย PHP (Optimize with JavaScript)</h2>
<div style="float:right">
	<a href="javascript:jsMonCalen()">เดือน</a> | <a href="javascript:loadWeekCalendar()">สัปดาห์</a> | <a href="javascript:loadDayCalendar();">วัน</a> | <a href="javascript:void(0)">แผนงาน</a>
</div>
<div style="clear:both"/>
<div id="main">
	<div id="my_calendar"></div>
</div>
<br />
<input id="test" type="button" value="TEST Template" onclick="Test()"/>

<address>
<br/>ที่มา : <a href="http://www.sunzan-design.com">http://www.sunzan-design.com</a>
</address>

<script type='text/javascript' src="themes/example/js/calendar.js"></script>
<script type='text/javascript'>
	jsMonCalen();
</script>
