<div id="nav">
	<button class="navLeft" onclick="loadWeekCalendar('{prevWeek}');"><< สัปดาห์ที่แล้ว</button>
	<div class="title">{title}</div>
	<button class="navRight" onclick="loadWeekCalendar('{nextWeek}');">สัปดาห์ต่อไป >></button>
</div>
<div style="clear:both"></div>
<table id="tb_calendar" border="1">
	<tr>
		<th>&nbsp;</th>
		{thead_day}
		<th>{day_of_week}<br>{date_month}</th>
		{/thead_day}
	</tr>
	{hour_list}
	<tr>
		<td>{hr}</td>
		<td>{d1}</td>
		<td>{d2}</td>
		<td>{d3}</td>
		<td>{d4}</td>
		<td>{d5}</td>
		<td>{d6}</td>
		<td>{d7}</td>
	</tr>
	{/hour_list}
</table>