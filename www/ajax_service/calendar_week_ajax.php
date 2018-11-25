<?php

/***** FUNCTION DEFINED  *****/
function genWeekCalenForJS()
{
	$currentTime 	= strtotime("2013-10-02");
	$currentPoint 	= date('w', $currentTime); 						//ลำดับวันประจำสัปดาห์ 0-6 ได้เท่ากับ 3
	$startTime 		= strtotime("-$currentPoint day", $currentTime);//-3 วัน เท่ากับ  คือวันที่ 2013-09-29 จะได้ 1380412800

	$date = array();
	for($i=0; $i<=6; $i++){
		$date[] = date('d/m', strtotime("+$i day", $startTime));
	}

	$data = array();
	//------ Database Query Current Month Only ------//
	//$data[{time}][{day}][] = $rs;
	$data['09:00']['01'][] = array('tb_event', '120', 'กิจกรรม 1');
	$data['09:30']['03'][] = array('tb_follow', '875', 'ติดตาม 2');
	$data['10:30']['04'][] = array('tb_follow', '11045', 'ติดตาม 1');
	$data['12:45']['06'][] = array('tb_news', '1054', 'ข่าวสาร 3');
	$data['14:00']['08'][] = array('tb_news', '1114', 'ข่าวสาร 4');
	$data['15:15']['10'][] = array('tb_news', '1114', 'ข่าวสาร 5');
	$data['16:00']['11'][] = array('tb_event', '1145', 'กิจกรรม 4');
	$data['16:00']['22'][] = array('tb_event', '1147', 'กิจกรรม 5');
	//------ Database Query ------//

	$json = array( 
				'month' 	=> $month, 
				'year' 		=> $year,
				'prevWeek' 	=> $prevMon, 
				'nextWeek' 	=> $nextYear,
				'date' 		=> $date,
				'item' 		=> $data
			);
	echo json_encode($json);

	//echo '<pre>', print_r($date, true), '</pre>';//ดูผลลัพธ์
}

function genWeekCalen()
{
	$currentTime 	= strtotime("2013-10-02");
	$currentPoint 	= date('w', $currentTime); 						//ลำดับวันประจำสัปดาห์ 0-6 ได้เท่ากับ 3
	$startTime = strtotime("-$currentPoint day", $currentTime);//-3 วัน เท่ากับ  คือวันที่ 2013-09-29 จะได้ 1380412800
	
	$month = isset($_POST['month']) ? $_POST['month'] : date('m'); 	//ถ้าส่งค่าเดือนมาใช้ค่าที่ส่งมา ถ้าไม่ส่งมาด้วย ใช้เดือนปัจจุบัน
	$year = isset($_POST['year']) ? $_POST['year'] : date('Y'); 		//ถ้าส่งค่าปีมาใช้ค่าที่ส่งมา ถ้าไม่ส่งมาด้วย ใช้ปีปัจจุบัน

	$weekDay = array( 'อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสฯ', 'ศุกร์', 'เสาร์');
	$date = array();
	for($i=0; $i<=6; $i++){
		$date[] = array('day_of_week' => $weekDay[$i], 'date_month' => date('d/m', strtotime("+$i day", $startTime)) );
	}

	$data = array();
	//------ Database Query Current Month Only ------//
	//$data[{hr}][{day/month}][] = $rs;
	/*
	$data['9']['29/09'][] = array('tb_event', '120', 'กิจกรรม 1', '2013-09-08 09:30:00');  		//0
	$data['9']['30/09'][] = array('tb_follow', '875', 'ติดตาม 2', '2013-09-12 09:00:00');		//1
	
	$data['10']['01/10'][] = array('tb_follow', '11045', 'ติดตาม 1', '2013-09-12 10:00:00');	//2
	$data['12']['03/10'][] = array('tb_news', '1054', 'ข่าวสาร 3', '2013-09-11 12:00:00');		//4
	$data['14']['05/10'][] = array('tb_news', '1114', 'ข่าวสาร 4', '2013-09-09 14:00:00');		//6
	$data['15']['04/10'][] = array('tb_news', '1114', 'ข่าวสาร 5', '2013-09-10 15:00:00');		//5
	
	$data['16']['04/10'][] = array('tb_event', '1145', 'กิจกรรม 4', '2013-09-10 16:00:00');		//5
	$data['16']['01/10'][] = array('tb_event', '1147', 'กิจกรรม 5', '2013-09-12 16:00:00');		//2
	*/
	//------ Database Query ------//
	
	//    0		  1       2		  3		  4		  5		  6
	//["29/09","30/09","01/10","02/10","03/10","04/10","05/10"]
	// switch({day/month}){
	//	case $date[0]['date_month']: $key = 'day1'; break;
	// }
	$data = array(
					array(
						'hr' => '9', 
						'day1' => array('tb_event', '120', 'กิจกรรม 1', date('Y-m').'-08 09:30:00'),
						'day2' => array('tb_follow', '875', 'ติดตาม 2', date('Y-m').'-12 09:00:00')
					),
					array(
						'hr' => '10', 
						'day1' => array(),
					),
					array(
						'hr' => '12', 
						'day1' => array(),
					),
					array(
						'hr' => '14', 
						'day1' => array(),
					)
				);

	$json = array( 
				'month' 	=> $month, 
				'year' 		=> $year,
				'prevWeek' 	=> $prevMon, 
				'nextWeek' 	=> $nextYear,
				'thead_day' => $date,
				'hour_list' => $data
			);
	echo json_encode($json);
}
/***** END DEFINE FUNCTION *****/


/***** Call Function *****/
$action = isset($_POST['action']) ? $_POST['action'] : '';
switch( $action ){
	case 'week_calen':
		//genWeekCalenForJS();
		genWeekCalen();
		break;
	case 'other':
		OtherFunction();
		break;
}
/***** END Call *****/

?>