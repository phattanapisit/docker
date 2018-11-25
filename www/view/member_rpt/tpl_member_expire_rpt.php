<table id="tb_memexpr_rpt" border="1">
	<tr>
		<th>ลำดับ</th>
		<th>ชื่อสาขา</th>
		<th>จำนวนสมาชิกทั้งหมด</th>
		<th>สถานะปกติ</th>
		<th>สถานะหมดอายุ</th>
	</tr>
	{list}
	<tr>
		<td>{no}</td>
		<td>{branch}</td>
		<td>{total}</td>
		<td>{active_qty}</td>
		<td>{expire_qty}</td>
	</tr>
	{/list}
</table>