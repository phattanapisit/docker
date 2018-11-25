<table id="tbl_questionnaire" width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr class="tr_title">
		<th>ลำดับ</th><th>หัวข้อ</th><th>สถานะ</th>
	</tr>
	{data_list}
	<tr>
		<td>{no}</td><td>{title}</td><td>{status}</td>
	</tr>
	{/data_list}
	<tr style="{no_result_display}">
		<td colspan="3" class="no_data">ไม่พบรายการ</td>
	</tr>
</table>