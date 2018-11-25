<?php   if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="themes/example/css/calendar.css" type="text/css" />
<script type='text/javascript'>
function goTo(month, year){
	window.location.href = "index.php?page=calendar&year="+ year +"&month="+ month;
}
</script>
<?php

$weekDay = array( 'อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสฯ', 'ศุกร์', 'เสาร์');

$thaiMon = array( "01" => "มกราคม", "02" => "กุมภาพันธ์", "03" => "มีนาคม", "04" => "เมษายน",
				"05" => "พฤษภาคม","06" => "มิถุนายน", "07" => "กรกฎาคม", "08" => "สิงหาคม",
				"09" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม");
				
//Sun - Sat
$month = isset($_GET['month']) ? $_GET['month'] : date('m'); 	//ถ้าส่งค่าเดือนมาใช้ค่าที่ส่งมา ถ้าไม่ส่งมาด้วย ใช้เดือนปัจจุบัน
$year = isset($_GET['year']) ? $_GET['year'] : date('Y'); 		//ถ้าส่งค่าปีมาใช้ค่าที่ส่งมา ถ้าไม่ส่งมาด้วย ใช้ปีปัจจุบัน
 
//วันที่
$startDay = $year.'-'.$month."-01";   		//วันที่เริ่มต้นของเดือน
 
$timeDate = strtotime($startDay);   		//เปลี่ยนวันที่เป็น timestamp
$lastDay = date("t", $timeDate);   			//จำนวนวันของเดือน
 
$endDay = $year.'-'.$month."-". $lastDay;  	//วันที่สุดท้ายของเดือน

$startPoint = date('w', $timeDate);   		//จุดเริ่มต้น วันในสัปดาห์
 
//ลดเวลาลง 1 เดือน
$prevMonTime = strtotime ( '-1 month' , $timeDate  );
$prevMon = date('m', $prevMonTime);
$prevYear = date('Y', $prevMonTime);

//เพิ่มเวลาขึ้น 1 เดือน
$nextMonTime = strtotime ( '+1 month' , $timeDate  );
$nextMon = date('m', $nextMonTime);
$nextYear = date('Y', $nextMonTime);

$title = "เดือน $thaiMon[$month] <strong>". $startDay. " : ". $endDay."</strong>";
 
echo '<div id="main">';
echo '<div id="nav">
	<button class="navLeft" onclick="goTo(\''.$prevMon.'\', \''.$prevYear.'\');"><< เดือนที่แล้ว</button>
	<div class="title">'.$title.'</div>
	<button class="navRight" onclick="goTo(\''.$nextMon.'\', \''.$nextYear.'\');">เดือนต่อไป >></button>
	</div>
	<div style="clear:both"></div>';
echo "<table id='tb_calendar' border='1'>"; //เปิดตาราง
echo "<tr>
		<th>อาทิตย์</th><th>จันทร์</th><th>อังคาร</th><th>พุธ</th><th>พฤหัสฯ</th><th>ศุกร์</th><th>เสาร์</th>
	</tr>";
echo "<tr>";    				//เปิดแถวใหม่
$col = $startPoint;          	//ให้นับลำดับคอลัมน์จาก ตำแหน่งของ วันในสับดาห์


if($startPoint < 7){         	//ถ้าวันอาทิตย์จะเป็น 7
	echo str_repeat("<td class='prev_month'> </td>", $startPoint); //สร้างคอลัมน์เปล่า กรณี วันแรกของเดือนไม่ใช่วันอาทิตย์
}
$row = 0;						//นับว่าครบ 6 แถวหรือยัง
for($i=1; $i <= $lastDay; $i++){ //วนลูป ตั้งแต่วันที่ 1 ถึงวันสุดท้ายของเดือน
	$col++;       					//นับจำนวนคอลัมน์ เพื่อนำไปเช็กว่าครบ 7 คอลัมน์รึยัง
	echo "<td>", $i , "</td>";  	//สร้างคอลัมน์ แสดงวันที่
	if($col % 7 == false){   		//ถ้าครบ 7 คอลัมน์ให้ขึ้นบรรทัดใหม่
		echo "</tr><tr>";   			//ปิดแถวเดิม และขึ้นแถวใหม่
		$col = 0;     				//เริ่มตัวนับคอลัมน์ใหม่
		$row++;
	}
}


$c = 7-$col;
$args = range(1, $c);
	
if($col < 7){        // ถ้ายังไม่ครบ7 วัน  สร้างคอลัมน์ให้ครบตามจำนวนที่ขาด
	$string = str_repeat("<td class='next_month'>%s</td>", $c);
	echo vsprintf($string, $args);
}
echo '</tr>';  		//ปิดแถวสุดท้าย


if($row < 7){		//เพิ่มอีกแถว
	$c = max($args);
	$args = range($c+1, $c+7);
	$string = str_repeat("<td class='next_month'>%s</td>", count($args));
	echo vsprintf($string, $args);
}

echo '</table>'; 	//ปิดตาราง
echo '</main>';
?>