
/*----------------GLOBAL VARIABLES ---------*/
var QUESTION_ADDED_COLOR = "#999";
var QUESTION_ADDED_OUTLINE = "#EFDAA5 solid 5px";
// ________________________________________________________________
// |-------------------------INITIALIZATIONS-----------------------|
// `````````````````````````````````````````````````````````````````
$(document).ready(function(e) {
    console.log("Loading que_questionnaire.js...");
    $('#que-topbar-nav-list a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });
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
function questionnaireSearch(data) {
    $("#questionnaire-result").html(data["questionnaire_search_results"]);//"question_row" is the thing that addQuestion controller submitted

}
function addQuestion(data) {
    //$("#gb-add-commitment-modal").modal("hide");
    //alert(dat);
    $("#que-questionnaire-questions").append(data["question_row"]);//"question_row" is the thing that addQuestion controller submitted
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
    $("body").on("click", ".que-view-answer-options-toggle", function(e) {
        e.preventDefault();
        $(this).next().toggle("slow");
    });
    $("body").on("click", ".add-question-btn", function(e) {
        e.preventDefault();
        var questionId = $(this).closest(".question-result-row").attr("question-id");
        var questionStatus = $(this).closest(".question-result-row").attr("question-status");
        var data = {question_id: questionId,
            question_status: questionStatus};//????
        ajaxCall(addQuestionUrl, data, addQuestion);
        $(this).closest(".question-result-row").addClass("question-added-row")
                .find(".added-notification").removeClass("hidden");
    });

    $("body").on("click", ".que-add-all-questionnaire-questions", function(e) {
        e.preventDefault();
        $(this).closest(".accordion-group").find(".add-question-btn").each(function() {
            $(this).click();
        });

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
        var questionId = $(this).closest(".question-result-row").attr("question-id");
        var data = {question_id: questionId};
        ajaxCall(moreInfoQuestionUrl, data, moreInfoQuestion);
    });



}

function editQuestionnaireHandlers() {
    $('#que-questionnaire-activity-nav a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });
    $("#que-questionnaire-questions").sortable();
    $("#que-questionnaire-questions").disableSelection();

    $("body").on("click", ".que-edit-question-btn", function(e) {
        e.preventDefault();
        $(this).closest(".question-row").find(".que-question-action-links").hide("fast");
        $(this).closest(".question-row").find(".que-question-text").hide("fast");
        $(this).closest(".question-row").find(".que-edit-question-submit-btn-row").show("slow");
        $(this).closest(".question-row").find(".edit-question-input").show("slow");
    });
    $("body").on("click", ".que-cancel-edit-question-btn, .que-save-edit-question-btn", function(e) {
        e.preventDefault();
        $(this).closest(".question-row").find(".que-edit-question-submit-btn-row").hide("fast");
        $(this).closest(".question-row").find(".edit-question-input").hide("slow");
        $(this).closest(".question-row").find(".que-question-action-links").show("slow");
        $(this).closest(".question-row").find(".que-question-text").show("slow");
    });
    $("body").on("click", ".que-edit-question-btn", function(e) {
        e.preventDefault();
        $(this).closest(".question-row").find(".que-edit-question-content")
                .text($(this).closest(".question-row").find(".que-question-content").text())
                .select();
    });
    $("body").on("click", ".que-save-edit-question-btn", function(e) {
        e.preventDefault();
        var content =  $(this).closest(".question-row").find(".que-edit-question-content").val();
        if (content.trim() == "") {
            alert("Question Content cannot be empty");
        } else {
            var user_question_id =  $(this).closest(".question-row").attr("user-question-id");
            var data = {user_question_id: user_question_id,
                content: content.trim()};
            ajaxCall(editQuestionUrl, data, editQuestion);
        }
    });
}