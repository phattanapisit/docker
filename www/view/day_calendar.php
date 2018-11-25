<div id="nav">
	<button class="navLeft" onclick="loadDayCalendar('{prevDay}');"><< วันที่แล้ว</button>
	<div class="title">{title}</div>
	<button class="navRight" onclick="loadDayCalendar('{nextDay}');">วันต่อไป >></button>
</div>
<div style="clear:both"></div>
<table id="tb_calendar" border="1" width="1000">
	<tr>
		<th style="width:10%">&nbsp;</th>
		<th style="">{day_of_week}<br>{date_month}</th>
	</tr>
	{hour_list}
	<tr>
		<td>{hr}</td>
		<td>{link}</td>
	</tr>
	{/hour_list}
</table>


