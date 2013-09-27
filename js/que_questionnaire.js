// ________________________________________________________________
// |-------------------------INITIALIZATIONS-----------------------|
// `````````````````````````````````````````````````````````````````

$(document).ready(function(e) {
	console.log("Loading que_questionnaire.js...");
	addQuestionEventHandlers();
});
function ajaxCall(url, data, callback) {
	$.ajax({
		url: url,
		type: "POST",
		dataType: 'json',
		data: data,
		success: callback
	});
}
function addQuestion(data) {
	//$("#gb-add-commitment-modal").modal("hide");
	//alert(dat);
	$("#question-row").append(data["question_row"]);
}


function addQuestionEventHandlers() {
$("body").on("click", ".add-question-btn", function(e) {
		e.preventDefault();
		var question_id = $(this).attr("question-id");
		//alert(question_id);
		var data = {question_id: question_id};
		ajaxCall(addQuestionUrl, data, addQuestion);
	});
	$("body").on("click", ".edit-question-btn", function(e) {
		e.preventDefault();
		$('#edit-question-input').val($(this).attr("question-content"));
		$('#edit-question-input').select();
		var question_id = $(this).attr("question-id");
		//alert(question_id);
		var data = {question_id: question_id};
		
		//ajaxCall(addQuestionUrl, data, addQuestion);
	});
}
