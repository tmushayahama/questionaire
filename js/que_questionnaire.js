// ________________________________________________________________
// |-------------------------INITIALIZATIONS-----------------------|
// `````````````````````````````````````````````````````````````````

$(document).ready(function(e) {
    console.log("Loading que_questionnaire.js...");
    searchEventHandlers();
    addQuestionEventHandlers();
    editQuestionnaireHandlers();
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
function questionnaireSearch(data){
        $("#questionnaire-result").append(data["questionnaire_search_results"]);//"question_row" is the thing that addQuestion controller submitted
  
}
function addQuestion(data) {
    //$("#gb-add-commitment-modal").modal("hide");
    //alert(dat);
    $("#question-row").append(data["question_row"]);//"question_row" is the thing that addQuestion controller submitted
    //$("#add-question-"+question_id).css("color","#999999");//the only way????
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

function searchEventHandlers() {
     $("#que-search-questionnaire-btn").click(function(e) {
        e.preventDefault();
        var data = $("#search-questionnaire-form").serialize();
        ajaxCall(questionnaireSearchUrl, data, questionnaireSearch);
    });
}

function addQuestionEventHandlers() {
    $("body").on("click", ".add-question-btn", function(e) {
        e.preventDefault();
        var question_id = $(this).attr("question-id");
        //alert(question_id);
        var data = {question_id: question_id};//????
        $("#display-question-" + question_id).css("background-color", "#E0F2F7");//the only way????
        ajaxCall(addQuestionUrl, data, addQuestion);//?????
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
        $('#edit-scale-input').val('');
    });
    $("body").on("click", ".remove-question-btn", function(e) {
        e.preventDefault();
        var userQuestion_id = $(this).attr("userQuestion_id");
        var data = {userQuestion_id: userQuestion_id};
        ajaxCall(removeQuestionUrl, data);
    });
    $("body").on("click", ".qRemove-question-btn", function(e) {
        e.preventDefault();
        var question_id = $(this).attr("question-id");
        var data = {question_id: question_id};
        $("#display-question-" + question_id).css("background-color", "transparent");
        ajaxCall(qRemoveQuestionUrl, data);
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

function editQuestionnaireHandlers() {
    $('#que-questionnaire-activity-nav a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });
    $("#sortable").sortable();
    $("#sortable").disableSelection();
}