 <script>
 var ajaxURL = "ajax_service.php?source=member";
$(function(){
	function log( message ) {
		$( "<div>" ).text( message ).prependTo( "#log" );
		$( "#log" ).scrollTop( 0 );
	}
	$( "#birds" ).autocomplete({
		source: ajaxURL + "&action=search",
		minLength: 2,
		select: function( event, ui ) {
			log( ui.item ?
			ui.item.id + " : " + ui.item.value :
			"Nothing selected, input was " + this.value );
		}
	});
});
</script>
<h2>ปรับแต่ง Autocomplete เพื่อลดการคิวรี่ MySQL</h2>
<br/>
<table cellpadding="10">
	<thead>
		<tr>
			<th><h3 style="color:blue">Autocomplete แบบคิวรี่ทุกครั้ง</h3></th>
			<th><h3 style="color:green">Autocomplete แบบคิวรี่เก็บไว้ใน Array</h3></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<div class="ui-widget">
				<label for="birds">ค้นหาสมาชิก : </label>
				<input id="birds">
				</div>
				<div class="ui-widget" style="margin-top:2em; font-family:Arial">
				ผลลัพธ์ที่เลือก :
				<div id="log" style="height: 200px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
				</div>
			</td>
			<td>
				<div class="ui-widget">
				<label for="birds">ค้นหาสมาชิก : </label>
				<input id="user_fullname">
				</div>
				<div class="ui-widget" style="margin-top:2em; font-family:Arial">
				ผลลัพธ์ที่เลือก :
				<div id="log2" style="height: 200px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
				</div>
				
			</td>
		</tr>
	</tbody>
</table>


<!-- ส่วนนี้คือไฟล์ที่สร้างไว้เรียบร้อยแล้ว ในตัวอย่างจะเป็นไฟล์เปล่า -->
<script type="text/javascript">
var autoCompleteData = new Array();

function setAutoComplete(){
	$( "#user_fullname" ).autocomplete({
	  minLength: 0,
	  source: autoCompleteData,
	  select: function( event, ui ) {
		//$( "#user_fullname" ).val( ui.item.label );
		$( "<div>" ).text( ui.item.value + ' : ' + ui.item.label ).prependTo( "#log2" );
		$( "#log2" ).scrollTop( 0 );
		return false;
	  }
	})
	.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
	  return $( "<li>" )
		.append( "<a>" + item.label + "</a>" )
		.appendTo( ul );
	};
}
//เรียกข้อมูลสมาชิกมาเก็บไว้ในตัวแปร autoCompleteData ผ่านการรับส่งข้อมูลแบบ AJAX
$.ajax({
	dataType: "json",
	url: ajaxURL + "&action=query",
	success: function(return_data){
		autoCompleteData = return_data;
		setAutoComplete();
	}
});
</script> 