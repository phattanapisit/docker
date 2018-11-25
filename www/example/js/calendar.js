var ajaxURL = 'ajax_service.php?source=calendar';

/* Load Templates */
var templateTest = loadContent('test.php');
var tplWeekCalen = loadContent('week_calendar.php');
var tplDayCalen = loadContent('day_calendar.php');

/* Example */
function loadMonthCalendar(month, year){
	var param = '';
	if(month) param += '&month=' + month;
	if(year)  param += '&year=' + year;
	sendPost('#my_calendar', ajaxURL, 'action=month' + param);
}

/*------- MONTH -------*/
function successJsMonCalen(data){
	var calendarTable = '';
	var obj = jQuery.parseJSON(data);
	var res, htmlData, title, rs, day;
	var weekDay = new Array( 'อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสฯ', 'ศุกร์', 'เสาร์');
	var thaiMon = new Array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	var col = 0,cn = 0, row = 0;
	var startPrev, endDay;	
	
	if(obj.startPoint == 0){
		calendarTable += '<tr>';
		startPrev = obj.prevDay - 6;
		for(d=startPrev; d<=obj.prevDay; d++){
			calendarTable += '<td class="prev_month">' + d + '</td>';
		}
		calendarTable += '</tr>';
		row++;
	}
	
	calendarTable += '<tr>';
	
	//สร้างคอลัมน์เปล่า กรณี วันแรกของเดือนไม่ใช่วันอาทิตย์
	if(obj.startPoint > 0 && obj.startPoint < 7){
		startPrev = obj.prevDay - (obj.startPoint-1);
		for(d=startPrev; d<=obj.prevDay; d++){
			calendarTable += '<td class="prev_month">' + d + '</td>';
		}
	}
	
	col = obj.startPoint;
	for(d=1; d<=obj.lastDay; d++){
		col++;       					//นับจำนวนคอลัมน์ เพื่อนำไปเช็กว่าครบ 7 คอลัมน์รึยัง
		title = '';
		
		day = (d < 10) ? '0'+d : d;
		res = obj.item[day];
		if(res != undefined){
			cn = res.length;
			for (var i=0; i< cn; i++){
				rs = res[i];
				title += '<div><a href="index.php?page=view_detail&source=' + rs[0] + '&ref=' + rs[1] + '">' + rs[2] + '</a></div>';
			}
		}
		calendarTable += "<td>" + d + title + "</td>";  //สร้างคอลัมน์ แสดงวันที่
		if(col % 7 == 0){   			//ถ้าครบ 7 คอลัมน์ให้ขึ้นบรรทัดใหม่
			calendarTable += "</tr><tr>";   			//ปิดแถวเดิม และขึ้นแถวใหม่
			col = 0;     					//เริ่มตัวนับคอลัมน์ใหม่
			row++;
		}
	}
	
	
	// ถ้ายังไม่ครบ7 วัน  สร้างคอลัมน์ให้ครบตามจำนวนที่ขาด
	if(col < 7){
		cn = 7-col;
		for(d=1; d<=cn; d++){
			calendarTable += '<td class="next_month">' + d + '</td>';
		}
		row++;
	}
		
	calendarTable += '</tr>';
	
	//ถ้าไม่ครบ 6 แถว ให้เพิ่มอีกแถว
	if(row < 6){		
		calendarTable += '<tr>';
		endDay = cn + 7;
		for(d=cn+1; d<=endDay; d++){
			calendarTable += '<td class="next_month">' + d + '</td>';
		}
		calendarTable += '</tr>';
	}
	var title = "เดือน " + thaiMon[obj.month-1] ;
	
	//-- HTML Table
	htmlData = '<div id="nav">'
			+ '<button class="navLeft" onclick="jsMonCalen(\'' + obj.prevMonth + '\', \'' + obj.prevYear + '\');"><< เดือนที่แล้ว</button>'
			+ '<div class="title">' + title + '</div>'
			+ '<button class="navRight" onclick="jsMonCalen(\'' + obj.nextMonth + '\', \'' + obj.nextYear + '\');">เดือนต่อไป >></button>'
			+ '</div>'
			+ '<div style="clear:both"></div>'
			+ '<table id="tb_calendar" border="1">'
			+ '<tr><th>' + weekDay.join("</th><th>") + '</th></tr>'
			+ calendarTable
			+ '</table>';
	//--
	
	$('#my_calendar').html(htmlData);
}

function jsMonCalen(month, year){
	var param = '';
	if(month) param += '&month=' + month;
	if(year)  param += '&year=' + year;
	sendPost('', ajaxURL, 'action=month_js' + param, successJsMonCalen );
}

/*-------- WEEK ----------*/
function successWeekCalen(data){
	var htmlData = parseHtml(tplWeekCalen, data);
	$('#my_calendar').html(htmlData);
}
function loadWeekCalendar(date){
	var param = '';
	if(date != undefined) param = '&date=' + date;
	getJSON(ajaxURL, 'action=week_calen' + param, successWeekCalen);
}


/*-------- DAY ----------*/
function successDayCalen(data){
	if(!data) return;
	$('#my_calendar').html(parseHtml(tplDayCalen, data));
}
function loadDayCalendar(date){
	var param = '';
	if(date != undefined) param = '&date=' + date;
	getJSON(ajaxURL, 'action=day_calen' + param, successDayCalen);
}

/*
function loadPlanCalendar(param){
	if(!param) param = '';
	sendPost('#my_calendar', ajaxURL, 'action=plan' + param);
}
*/
function successTest(data){
	if(!data) return;
	$('#my_calendar').html(parseHtml(templateTest, data));
}
function Test(date){
	var param = '';
	if(date != undefined) param = 'date=' + date;
	getJSON('ajax_service.php?source=test', 'action=loadTest' + param, successTest);
}