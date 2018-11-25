var ajaxURL = 'ajax_service.php?source=questionnair';
var tplQuestionnaireList = loadContent('tpl_questionnaire_list.php');

// Load รายการแบบสอบถามทั้งหมด
function successLoadQuestionnaire(data){
	var htmlData = parseHtml(tplQuestionnaireList, data);
	$('#qn_list').html(htmlData);
}
function loadQuestionnaire(xKeyword){
	var param = '';
	if(xKeyword) param += '&keyword=' + xKeyword;
	getJSON(ajaxURL, 'action=get_list' + param, successLoadQuestionnaire);
}