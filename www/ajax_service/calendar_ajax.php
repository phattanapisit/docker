<?php
/***** Defined Paramiter *****/

$weekDay = array( 'อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสฯ', 'ศุกร์', 'เสาร์');
$thaiMon = array( "01" => "มกราคม", "02" => "กุมภาพันธ์", "03" => "มีนาคม", "04" => "เมษายน",
				"05" => "พฤษภาคม","06" => "มิถุนายน", "07" => "กรกฎาคม", "08" => "สิงหาคม",
				"09" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม");

/***** FUNCTION DEFINED  *****/
function genMonthCalendar($dayOfWeek, $monthOfThai){
	//Sun - Sat
	$month = isset($_POST['month']) ? $_POST['month'] : date('m'); 	//ถ้าส่งค่าเดือนมาใช้ค่าที่ส่งมา ถ้าไม่ส่งมาด้วย ใช้เดือนปัจจุบัน
	$year = isset($_POST['year']) ? $_POST['year'] : date('Y'); 		//ถ้าส่งค่าปีมาใช้ค่าที่ส่งมา ถ้าไม่ส่งมาด้วย ใช้ปีปัจจุบัน

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

	$title = "เดือน ". $monthOfThai[$month];// ."<strong>". $startDay. " : ". $endDay."</strong>";
	
	$row = 0;			//นับว่าครบ 6 แถวหรือยัง
	$col = $startPoint;	//ให้นับลำดับคอลัมน์จาก ตำแหน่งของ วันในสับดาห์
	
	echo '<div id="main">';
	echo '<div id="nav">
		<button class="navLeft" onclick="loadMonthCalendar(\''.$prevMon.'\', \''.$prevYear.'\');"><< เดือนที่แล้ว</button>
		<div class="title">'.$title.'</div>
		<button class="navRight" onclick="loadMonthCalendar(\''.$nextMon.'\', \''.$nextYear.'\');">เดือนต่อไป >></button>
		</div>
		<div style="clear:both"></div>';
	echo "<table id='tb_calendar' border='1'>"; //เปิดตาราง
	echo "<tr><th>" . implode("</th><th>", $dayOfWeek) . "</th></tr>";
	
	$data = array();
	//------ Database Query ------//
	if($month == '09'){
		//$data[{day}][] 
		$data['01'][] = array('tb_event', '120', 'กิจกรรม 1');
		$data['02'][] = array('tb_follow', '875', 'ติดตาม 2');
		$data['13'][] = array('tb_follow', '11045', 'ติดตาม 1');
		$data['15'][] = array('tb_news', '1054', 'ข่าวสาร 3');
		$data['17'][] = array('tb_news', '1114', 'ข่าวสาร 4');
		$data['21'][] = array('tb_news', '1114', 'ข่าวสาร 5');
		$data['25'][] = array('tb_event', '1145', 'กิจกรรม 4');
		$data['25'][] = array('tb_event', '1147', 'กิจกรรม 5');
	}
	//------ Database Query ------//
		
	$prevDate = strtotime ( '-1 day' , strtotime ( $startDay ) ) ;
	$lastPrevDay = date ( 'd' , $prevDate );
	if($startPoint == 0){
		$args = range($lastPrevDay - 6, $lastPrevDay);
		$string = str_repeat("<td class='prev_month'>%s</td>", count($args));
		echo "<tr>". vsprintf($string, $args) . "</tr>";
		$row++;
	}
	
	echo "<tr>";
	//สร้างคอลัมน์เปล่า กรณี วันแรกของเดือนไม่ใช่วันอาทิตย์
	if($startPoint > 0 && $startPoint < 7){
		$args = range($lastPrevDay - ($startPoint-1), $lastPrevDay);
		$string = str_repeat("<td class='prev_month'>%s</td>", $startPoint);
		echo vsprintf($string, $args);
	}

	for($i=1; $i <= $lastDay; $i++){ //วนลูป ตั้งแต่วันที่ 1 ถึงวันสุดท้ายของเดือน
		$col++;       					//นับจำนวนคอลัมน์ เพื่อนำไปเช็กว่าครบ 7 คอลัมน์รึยัง
		$title = '';
		$day = substr("0".$i, -2);
		if(isset($data[$day]) && is_array($data[$day]) ){
			foreach($data[$day] as $rs){
				$title .= '<div><a href="index.php?page=view_detail&source='.$rs[0].'&ref='.$rs[1].'">'. $rs[2] . '</a></div>';
			}
		}
		echo "<td>", $i , $title , "</td>";  //สร้างคอลัมน์ แสดงวันที่
		if($col % 7 == false){   			//ถ้าครบ 7 คอลัมน์ให้ขึ้นบรรทัดใหม่
			echo "</tr><tr>";   			//ปิดแถวเดิม และขึ้นแถวใหม่
			$col = 0;     					//เริ่มตัวนับคอลัมน์ใหม่
			$row++;
		}
	}
	
	// ถ้ายังไม่ครบ7 วัน  สร้างคอลัมน์ให้ครบตามจำนวนที่ขาด
	if($col < 7){
		$c = 7-$col;
		$args = range(1, $c);
		$string = str_repeat("<td class='next_month'>%s</td>", $c);
		echo vsprintf($string, $args);
		$row++;
	}
	echo '</tr>';
	
	//ถ้าไม่ครบ 6 แถว ให้เพิ่มอีกแถว
	if($row < 6){		
		$c = max($args);
		$args = range($c+1, $c+7);
		$string = str_repeat("<td class='next_month'>%s</td>", count($args));
		echo "<tr>", vsprintf($string, $args) , "</tr>";
	}

	echo '</table>';
}

/* Optimize */
function genMonthCalendarJS(){

	$month = isset($_POST['month']) ? $_POST['month'] : date('m'); 	//ถ้าส่งค่าเดือนมาใช้ค่าที่ส่งมา ถ้าไม่ส่งมาด้วย ใช้เดือนปัจจุบัน
	$year = isset($_POST['year']) ? $_POST['year'] : date('Y'); 		//ถ้าส่งค่าปีมาใช้ค่าที่ส่งมา ถ้าไม่ส่งมาด้วย ใช้ปีปัจจุบัน

	$startDate = $year.'-'.$month."-01";   		//วันที่เริ่มต้นของเดือน
	$timeDate = strtotime($startDate);   		//เปลี่ยนวันที่เป็น timestamp
	$lastDay = date("t", $timeDate);   			//จำนวนวันของเดือน

	$startPoint = date('w', $timeDate);   		//จุดเริ่มต้น วันในสัปดาห์
	
	$prevDate = strtotime( '-1 day' , strtotime ( $startDate ) ) ;
	$prevDay = date ( 'd' , $prevDate );
	
	//ลดเวลาลง 1 เดือน
	$prevMonTime = strtotime( '-1 month' , $timeDate  );
	$prevMon = date('m', $prevMonTime);
	$prevYear = date('Y', $prevMonTime);

	//เพิ่มเวลาขึ้น 1 เดือน
	$nextMonTime = strtotime ( '+1 month' , $timeDate  );
	$nextMon = date('m', $nextMonTime);
	$nextYear = date('Y', $nextMonTime);
	
	$data = array();
	//------ Database Query ------//
	$data['01'][] = array('tb_event', '120', 'กิจกรรม 1');
	$data['02'][] = array('tb_follow', '875', 'ติดตาม 2');
	$data['13'][] = array('tb_follow', '11045', 'ติดตาม 1');
	$data['15'][] = array('tb_news', '1054', 'ข่าวสาร 3');
	$data['17'][] = array('tb_news', '1114', 'ข่าวสาร 4');
	$data['21'][] = array('tb_news', '1114', 'ข่าวสาร 5');
	$data['25'][] = array('tb_event', '1145', 'กิจกรรม 4');
	$data['25'][] = array('tb_event', '1147', 'กิจกรรม 5');
	//------ Database Query ------//
	
	$json = array( 
				'month' => $month, 
				'year' => $year,
				'prevDay' => $prevDay,
				'prevMonth' => $prevMon, 
				'prevYear' => $prevYear,
				'nextMonth' => $nextMon,
				'nextYear' => $nextYear,
				'startDay' => 1,
				'lastDay' => $lastDay,
				'startPoint' => $startPoint,
				'item' => $data
			);
	echo json_encode($json);
}

function createWeekLink($rs){
	return '<div><a href="index.php?page=view_detail&source='.$rs[0].'&ref='.$rs[1].'">'. $rs[2] . '</a></div>';
}
function getDayIndex($value, $dayOfWeek){
	foreach($dayOfWeek as $index=>$arr){
		if($value == $arr['date_month']){
			return $index+1;
		}
	}
}
function genWeekCalenForJS()
{
	$weekDay = array( 'อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสฯ', 'ศุกร์', 'เสาร์');
	$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
	
	$currentTime 	= strtotime($date);
	$currentPoint 	= date('w', $currentTime); 						//ลำดับวันประจำสัปดาห์ 0-6 ถ้าวันที่ 2013-10-02 ได้เท่ากับ 3 
	$startTime 		= strtotime("-$currentPoint day", $currentTime);//-3 วัน เท่ากับ  คือวันที่ 2013-09-29 จะได้ 1380412800
	
	//ลดเวลาลง 1 สัปดาห์
	$prevWeekTime = strtotime( '-7 day' , $currentTime  );
	$prevWeek = date('Y-m-d', $prevWeekTime);

	//เพิ่มเวลาขึ้น 1 สัปดาห์
	$nextWeekTime = strtotime( '+7 day' , $currentTime  );
	$nextWeek = date('Y-m-d', $nextWeekTime);

	//thead
	$dateWeek = array();
	for($i=0; $i<=6; $i++){
		$dateWeek[$i] = array(
						'day_of_week' => $weekDay[$i], 
						'date_month' => date('d/m', strtotime("+$i day", $startTime)) 
					);
	}

	//tbody
	//------ Database Query Current Month Only ------//
	//$data[{time}] = $rs;
	$data = array();
	$data['08'][] = array('tb_news', '120', 'ข่าวสาร 1', '05/'.date('m') );
	$data['09'][] = array('tb_event', '120', 'กิจกรรม 1', '10/'.date('m') );
	$data['09'][] = array('tb_follow', '875', 'ติดตาม 2', '10/'.date('m'));
	$data['08'][] = array('tb_follow', '875', 'ติดตาม 3', '12/'.date('m'));
	$data['10'][] = array('tb_follow', '11045', 'ติดตาม 1', '13/'.date('m'));
	$data['12'][] = array('tb_news', '1054', 'ข่าวสาร 3', '14/'.date('m'));
	$data['14'][] = array('tb_news', '1114', 'ข่าวสาร 4', '15/'.date('m'));
	$data['15'][] = array('tb_news', '1114', 'ข่าวสาร 5', '16/'.date('m'));
	$data['16'][] = array('tb_event', '1145', 'กิจกรรม 4', '12/'.date('m'));
	$data['06'][] = array('tb_news', '1146', 'ข่าวสาร 7', '20/'.date('m'));
	$data['11'][] = array('tb_event', '1146', 'กิจกรรม 5', '24/'.date('m'));
	$data['07'][] = array('tb_follow', '1146', 'ติดตาม 5', '27/'.date('m'));
	$data['09'][] = array('tb_news', '1146', 'ข่าวสาร 6', '29/'.date('m'));
	//--- end db query ----//
	
	$dataList = array();
	$arr = array();
	for($hr=0;$hr<24;$hr++){
		if(strlen($hr)==1) $hr = "0".$hr;

		$d1 = '';
		$d2 = '';
		$d3 = '';
		$d4 = '';
		$d5 = '';
		$d6 = '';
		$d7 = '';
		if(isset($data[$hr])){
			foreach($data[$hr] as $rs){
				$key = getDayIndex($rs[3], $dateWeek);
				if($key) ${"d$key"} .= createWeekLink($rs);
			}
		}
		
		$arr = array(
					'hr' => "$hr:00", 
					'd1' => $d1,
					'd2' => $d2,
					'd3' => $d3,
					'd4' => $d4,
					'd5' => $d5,
					'd6' => $d6,
					'd7' => $d7,
				);
		$dataList[] = $arr;
	}
	//------ Database Query ------//
	
	$title = "";
	$json = array(
				'prevWeek' 	=> $prevWeek, 
				'nextWeek' 	=> $nextWeek,
				'title' => $title,
				'hour_list' => $dataList,
				'thead_day' => $dateWeek,
			);
	echo json_encode($json);
	//echo '<pre>', print_r($data, true), '</pre>';//ดูผลลัพธ์

}

function genDayCalen()
{
	$weekDay = array( 'อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสฯ', 'ศุกร์', 'เสาร์');
	$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
	
	$currentTime 	= strtotime($date);
	$currentPoint 	= date('w', $currentTime); 						//ลำดับวันประจำสัปดาห์ 0-6 ถ้าวันที่ 2013-10-02 ได้เท่ากับ 3 
	$startTime 		= strtotime("-$currentPoint day", $currentTime);//-3 วัน เท่ากับ  คือวันที่ 2013-09-29 จะได้ 1380412800
	
	//ลดเวลาลง 1 สัปดาห์
	$prevDayTime = strtotime( '-1 day' , $currentTime  );
	$prevDay = date('Y-m-d', $prevDayTime);

	//เพิ่มเวลาขึ้น 1 สัปดาห์
	$nextDayTime = strtotime( '+1 day' , $currentTime  );
	$nextDay = date('Y-m-d', $nextDayTime);

	//thead
	$day_of_week = $weekDay[$currentPoint];
	$date_month = date('d/m', $currentTime);


	//tbody
	//------ Database Query Current Month Only ------//
	//$data[{time}] = $rs;
	$data = array();
	$data['09'][] = array('tb_event', '120', 'กิจกรรม 1');
	$data['09'][] = array('tb_follow', '875', 'ติดตาม 2');
	$data['08'][] = array('tb_follow', '875', 'ติดตาม 2');
	$data['10'][] = array('tb_follow', '11045', 'ติดตาม 1');
	$data['12'][] = array('tb_news', '1054', 'ข่าวสาร 3');
	$data['14'][] = array('tb_news', '1314', 'ข่าวสาร 4');
	$data['16'][] = array('tb_news', '1154', 'ข่าวสาร 5');
	$data['07'][] = array('tb_event', '1145', 'กิจกรรม 4');
	$data['20'][] = array('tb_news', '1134', 'ข่าวสาร 4');
	$data['23'][] = array('tb_news', '1224', 'ข่าวสาร 5');
	$data['23'][] = array('tb_event', '1445', 'กิจกรรม 4');
	//--- end db query ----//
	
	$dataList = array();
	$arr = array();
	for($hr=0;$hr<24;$hr++){
		if(strlen($hr)==1) $hr = "0".$hr;

		$link = '';
		if(isset($data[$hr])){
			foreach($data[$hr] as $rs){
				$link .= createWeekLink($rs);
			}
		}
		$arr = array(
					'hr' => "$hr:00", 
					'link' => $link,
				);
		$dataList[] = $arr;
	}
	//------ Database Query ------//
	
	$title = "";
	$json = array(
				'prevDay' 	=> $prevDay, 
				'nextDay' 	=> $nextDay,
				'title' => $title,
				'hour_list' => $dataList,
				'day_of_week' => $day_of_week,
				'date_month' => $date_month
			);
	echo json_encode($json);
}
/***** END DEFINE FUNCTION *****/


/***** Call Function *****/
$action = isset($_POST['action']) ? $_POST['action'] : '';
if($action == '') $action = isset($_GET['action']) ? $_GET['action'] : '';
switch( $action ){
	case 'month':
		genMonthCalendar($weekDay, $thaiMon);
		break;
	case 'month_js':
		genMonthCalendarJS();
		break;
	case 'week_calen':
		genWeekCalenForJS();
		break;
	case 'day_calen':
		genDayCalen();
		break;
	case 'plan':
	
		break;
}

?>