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
function editQuestion(data) {
	//$("#gb-add-commitment-modal").modal("hide");
	//alert(dat);
	//$("#question-row").append(data["question_row"]);
}
function moreInfoQuestion(data) {
	//$("#gb-add-commitment-modal").modal("hide");
	//alert(dat);
	$('#que-more-info-question-content').text(data["content"]);
	$('#que-more-info-question-tool').text(data["tool"]);
	$('#que-more-info-question-concept').text(data["concept"]);
	$('#que-more-info-question-author').text(data["author"]);
	$('#que-more-info-question-year').text(data["year"]);
	$("#question-more-info-modal").modal("show");
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
		$('#edit-question-input').attr('question-id', question_id);
		var question_id = $(this).attr("question-id");
		var data = {question_id: question_id};
		$('#edit-question-input').select();
		//ajaxCall(addQuestionUrl, data, addQuestion);
	});
	$("body").on("click", ".edit-add-question-btn", function(e) {
		e.preventDefault();
		$("#edit-add-question-modal").modal("show");
		$('#edit-add-question-input').val($('#add-question-' + $(this).attr('question-id')).text());
		$('#edit-add-question-input').select();
	});


	$("body").on("click", "#que-more-question-info-btn", function(e) {
		e.preventDefault();
		$('#edit-question-input').select();
		//$('#edit-question-input').attr('question-id', question_id);
		var question_id = $(this).attr("question-id");
		var data = {question_id: question_id};
		ajaxCall(moreInfoQuestionUrl, data, moreInfoQuestion);
	});

	$("body").on("click", "#que-save-edited-btn", function(e) {
		e.preventDefault();
		var content = $('#edit-question-input').val();
		if (content.trim() == "") {
			alert("Question Content cannot be empty");
		} else {
			var question_id = $(this).attr("question-id");
			var data = {question_id: question_id,
				content: content.trim()};
			ajaxCall(editQuestionUrl, data, editQuestion);
		}


	});

}
