/*** First time Only ***/
function loadContent(xFileName,xDir)
{
	var tempContent;
	var xViewDir = "view/";//templete directory
	if(xDir != undefined && xDir != '') xViewDir += xDir + "/";
	$.ajax({
		type: "GET",
		url: xViewDir + xFileName,
		dataType: "text",
		async : false,	//synchronous requests
		success : function(data){tempContent = data;}
	});
	return tempContent;
}

/*** Matching & Replace ***/
function parseArray(text, xDataArray, mKey)
{
	var str = text;
	var regex = /{(.+?)}/g;
	$.each( xDataArray, function( key, value ){
		if(mKey) str = str.replace("{"+ mKey +"}", "").replace("{/"+ mKey +"}", "");
		if(typeof value == 'object'){
			text += parseArray(str, value);
		}else{
			text = str.replace(regex, function($0, $1){return xDataArray[$1];});
		}
	});
	return text;
}
function parseHtml(xTemplate, xData){
	if(xData){
		var result = xTemplate;
		$.each( xData, function( key, value ) {
			if($.isArray(value)){
				var patt = '/{'+key+'}([\\S\\s]*){\\/'+key+'}/g';// key 
				var patt = eval(patt);
				var text_array = result.match(patt);//array
				if(text_array != null){
					var textList = parseArray(text_array[0], value, key);
					textList = textList.replace(text_array[0], '');
					//result = result.replace(text_array[0], '') + textList; //มันจะไปต่อท้าย ทำให้ข้อมูลอยู่ผิดที่
					result = result.replace(text_array[0], textList);
				}
			}else{
				result = result.replace(eval('/{' + key + '}/g'), value);
			}
		});
		return result;
	}else{
		alert("รูปแบบของข้อมูลไม่ถูกต้อง parseHtml()");
	}
}

//------------------------------ เรียกใช้งาน --------------------------------------
/*
var ajaxURL = 'ajax_service.php?source=calendar';

var templateTest = loadContent('test.php');//เรียกครั้งเดียว

function successDayCalen(data){
	if(!data) return;
	$('#my_calendar').html(parseHtml(templateTest, data));
}
function loadDayCalendar(date){
	var param = '';
	if(date != undefined) param = 'date=' + date;
	$.ajax({
		dataType: "json",
		url: ajaxURL,
		data: param,
		success: successDayCalen
	});
}
*/