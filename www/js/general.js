function setMenuLink(page){
	//Set menu link
	$('#div_menu li').click(function() {
		window.location = $(this).attr('link');
	});
	
	//Set menu hover
	if(page == undefined || page == ''){
		page = 'index';
	}
	$('#'+page).css({'background-position': '-0px -53px',  'width': '200px', 'height': '49px'});
}

function msgBox(title, message){
	if(!title){ title = 'แจ้งเตือน';}
	$( "#dialog-message:ui-dialog" ).dialog( "destroy" );
	$("#dialog-message").html(message).attr('title', title);
	$( "#dialog-message" ).dialog({
		modal: true,
		buttons: {
			Ok: function() {
				$( this ).dialog( "close" );
			}
		}
	});
}

function showMsg(title, message){
	if( ! $( "#dialog-message" ).attr('id') ){
		$('body').append('<div id="dialog-message" title=""></div>');
	}
	$( "#dialog-message:ui-dialog" ).dialog( "destroy" );
	$( "#dialog-message" ).html(message).attr('title', title);
	$( "#dialog-message" ).dialog();
}

function MsgBox(message, title, options, actionScript){
	if( ! $( "#dialog-message" ).attr('id') ){
		$('body').append('<div id="dialog-message" title=""></div>');
	}
	$( "#dialog-message:ui-dialog" ).dialog( "destroy" );
	$( "#dialog-message" ).html(message).attr('title', title);
	
	if(options==undefined){//default => alert
		$( "#dialog-message" ).dialog({
			buttons: {
		        Ok: function() {
		          $( this ).dialog( "close" );
		        }
			}
		});
	}else if(options.btnCase=='confirm'){// set => confirm
		$( "#dialog-message" ).dialog({
		    resizable: false,
		    height:160,
		    modal: true,
		    buttons: {
		      "ยืนยัน": function() {
		    	if(actionScript) actionScript();
		        $( this ).dialog( "close" );
		      },
		      "ปิด": function() {
		        $( this ).dialog( "close" );
		      }
		    }
		});
	}else if(options.btnCase=='form'){// set => Display & Form
		//var btnForm;
		if(!options.btnSaveAction){//No save button
			var btnForm = {
				"ปิด": function() {
					$( this ).dialog( "close" );
			  }
			}
		}else{					//Save action
			var btnForm  = {
			  "บันทึก" : function(){
				options.btnSaveAction();
			  },
			  "ปิด": function() {
					$( this ).dialog( "close" );
			  }
			}
		}
		alert(btnForm);
		$( "#dialog-message" ).dialog({
			height: options.height,
			width: options.width,		
			modal: true,
		    buttons: btnForm
		});
	}else if(options.btnCase=='popup'){	// Display Message
		$( "#dialog-message" ).dialog({
			height: options.height,
			width: options.width,		
			modal: true
		});
	};
	
}

function hideMsg(){
	$( "#dialog-message:ui-dialog" ).dialog( "destroy" );
	$( ".ui-dialog" ).hide();
}

function sendPost(obj, url, data, callback){
	showMsg('กำลังทำรายการ', 'กรุณารอสักครู่...');
	$.post(url, data, function(result) {
		hideMsg();
		if(obj){$(obj).html(result);}
		if(callback){
			callback(result);
		}
	});
}

function sendGet(obj, url, data){
	showMsg('กำลังทำรายการ', 'กรุณารอสักครู่...');
	$.get(url, data, function(result) {
		hideMsg();
		$(obj).html(result);
	});
}

function getJSON(pUrl, pData, pSuccessJSON){
	$.ajax({
	  dataType: "json",
	  url: pUrl,
	  data: pData,
	  success: pSuccessJSON
	});
}

function goTo(url){
	window.location = url;
}

function zGetKey(ev){
	return (ev.keyCode ? ev.keyCode : ev.which);
}

function selectDate(obj, options){//datepicker

	$(obj).live('keydown', function(e) {
		var keycode = (zGetKey(e));
		if(keycode != "9"){ 
			$( obj ).blur().focus();
			return false; 
		}
	});//ไม่ให้พิมพ์เอง
	//var deteBefore=null;
	$(obj).live("focus", function(){
		var defaultDate = $(this).val().split("/");
		var defaultYear = defaultDate[2]-543;
		var dateBefore= defaultDate[0]+"-"+defaultDate[1]+"-"+defaultYear;
		$( this ).datepicker({
			dateFormat: 'dd-mm-yy',
			dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'], 
			monthNamesShort: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
			changeMonth: true,
			changeYear: true ,
			beforeShow:function(){
				$(this).keydown(function(e) {
					if(zGetKey(e) != "9")$(this).datepicker( "hide" );
				});//ไม่ให้พิมพ์เอง
				if($(this).val()!="" && $(this).val().length > 6){
					var arrayDate=$(this).val().split("/");		
					arrayDate[2]=parseInt(arrayDate[2])-543;
					$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);
				}
				setTimeout(function(){
					$.each($(".ui-datepicker-year option"),function(j,k){
						var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;
						$(".ui-datepicker-year option").eq(j).text(textYear);
					});				
				},50);
	
			},
			onChangeMonthYear: function(){
				setTimeout(function(){
					$.each($(".ui-datepicker-year option"),function(j,k){
						var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;
						$(".ui-datepicker-year option").eq(j).text(textYear);
					});				
				},50);		
			},
			onClose:function(){
				if($(this).val()!="" && $(this).val()== dateBefore){			
					var arrayDate=dateBefore.split("-");
					arrayDate[2]=parseInt(arrayDate[2])+543;
					$(this).val(arrayDate[0]+"/"+arrayDate[1]+"/"+arrayDate[2]);
					if(options != undefined){
						if(options.onClose) options.onClose();
					}
				}		
			},
			onSelect: function(dateText, inst){ 
				dateBefore=$(this).val();
				var arrayDate=dateText.split("-");
				arrayDate[2]=parseInt(arrayDate[2])+543;
				$(this).val(arrayDate[0]+"/"+arrayDate[1]+"/"+arrayDate[2]);
				if(options != undefined){
					if(options.onSelect) options.onSelect();
				}
			}
	
		});
	});
}

//ลายน้ำ
function setDefaultText(objSelector, message){
	var cssColor = $(objSelector).css('color');
	if($(objSelector).val() == '') $(objSelector).val(message);
	if($(objSelector).val() == message){
		$(objSelector).css('color', '#999999');
	}
	$(objSelector).focus(function(){//
		if($(this).val() == message) $(this).val('');
		$(objSelector).css('color', cssColor);
		
	}).blur(function(){//
		if($(this).val() == '' || $(this).val() == message){
			$(this).val(message);
			$(objSelector).css('color', '#999999');
		}else{
			$(objSelector).css('color', cssColor);
		}
	});
}

function hideObj(el){
	$(el).hide();
}

function viewPDF(xRptName, strSentData, xCase){
	if(!xCase) xCase = 0;
	var winOption = 'width='+ $(window).width() +',height=' +  ($(window).height()+120);
	window.open('report.php?rpt='+ xRptName + '&download=' + xCase + '&' + strSentData, '', winOption);
}


