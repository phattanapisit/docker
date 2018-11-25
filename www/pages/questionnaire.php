<?php   if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="themes/example/css/questionnaire.css" type="text/css" />
<h2>ตัวอย่างการสร้างแบบสอบถามด้วย PHP</h2>
<h5>
ค้นหารายการแบบสอบถาม <input type="text" name="keyword" />
<input type="button" id="btn_submit" value="ค้นหา" /> 
</h5>
<div id="main_qn_list">
	<div id="qn_list">
		
	</div>
</div>

<script type='text/javascript' src="themes/example/js/questionnaire.js"></script>
<script type='text/javascript'>
	loadQuestionnaire();
	
	$('#btn_submit').click(function(){
		loadQuestionnaire($('[name=keyword]').val());
	});
</script>