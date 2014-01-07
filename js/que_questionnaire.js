
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
    $('#ajax-loader').ajaxStart(function() {
        $(this).show();
    });
    $('#ajax-loader').ajaxComplete(function() {
        $(this).hide();
    });
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
/*function queConfirm(message) {
 $("#que-confirm-message").text(message);
 if ($('#que-confirm-btn').click()) {
 return true;
 } else if ($('#que-cancel-confirm-btn').click()) {
 return false;
 }
 }*/
function questionnaireSearch(data) {
    $("#que-questionnaire-result").html(data["questionnaire_search_results"]);//"question_row" is the thing that addQuestion controller submitted
}
function questionSearch(data) {
    $("#que-question-result").html(data["question_search_results"]);//"question_row" is the thing that addQuestion controller submitted
}
function addQuestion(data) {
    $("#que-questionnaire-questions").prepend(data["question_row"]);//"question_row" is the thing that addQuestion controller submitted
    //$("#add-question-"+question_id).css("color","#999999");//the only way????
    rearrangeNumbers("#que-questionnaire-questions");
}
function createQuestion(data) {
    $("#que-create-question-input").val("");
    $('a[href="#que-questionnaire-edit-pane"]').tab('show');
    $("#que-questionnaire-questions").prepend(data["question_row"]);//"question_row" is the thing that addQuestion controller submitted
    rearrangeNumbers("#que-questionnaire-questions");
}
function editQuestion(data) {
    $("#que-user-question-row-" + data["user_question_id"]).find(".que-question-content")
            .text(data["content"])
}
function moreInfoQuestion(data) {
    var questionResultRow = $("#question-result-row-" + data["question_id"]);
    questionResultRow.find('.que-more-info-question-concept').text(data["concept"]);
    questionResultRow.find('.que-more-info-question-author').text(data["author"]);
    questionResultRow.find('.que-more-info-question-year').text(data["year"]);
    questionResultRow.find(".que-more-info-question-row").show("slow");
}
function getUserQuestionToDelete(data) {
    $("#user-question-to-delete-modal .modal-body").html(data["user_questions_to_delete"]);
    $("#user-question-to-delete-modal").modal("show");
}
function removeQuestion(data) {
    $("#que-user-question-row-" + data["user_question_id"]).remove();
    rearrangeNumbers("#que-questionnaire-questions");
}
function removeFromSearchQuestion(data) {
    $("#que-user-question-row-" + data["user_question_id"]).remove();
    $("#from-results-remove-user-question-row-" + data["user_question_id"]).remove();
    if ($(".from-results-question-row").length == 0) {
         $("#user-question-to-delete-modal").modal("hide");
    }
    rearrangeNumbers("#que-questionnaire-questions");
}
function rearrangeNumbers(id) {
    var children = $(id).children();
    for (var i = 0; i < children.length; i++) {
        $(children[i]).find(".count").text(i + 1);
    }
}
function searchEventHandlers() {
    $("#que-search-questionnaire-btn").click(function(e) {
        e.preventDefault();
        var data = $("#search-questionnaire-form").serialize();
        ajaxCall(questionnaireSearchUrl, data, questionnaireSearch);
    });
    $("#que-search-question-btn").click(function(e) {
        e.preventDefault();
        var data = $("#search-question-form").serialize();
        ajaxCall(questionSearchUrl, data, questionSearch);
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
        if ($(this).attr("que-action") === "add") {
            ajaxCall(addQuestionUrl, data, addQuestion);
            $(this).attr("que-action", "remove");
            $(this).html("<i class='icon-minus-sign'></i> Remove");
            $(this).css("color", "#B96320");
            $(this).closest(".question-result-row").addClass("question-added-row")
                    .find(".added-notification").removeClass("hidden");
        } else {
            ajaxCall(getUserQuestionToDeleteUrl, data, getUserQuestionToDelete);
            // $(this).html("<i class='icon-plus-sign'></i> Add");
            // $(this).css("color", "#111");
            //$(this).closest(".question-result-row").removeClass("question-added-row")
            //      .find(".added-notification").addClass("hidden");
        }
    });

    $("body").on("click", ".que-add-all-questionnaire-questions", function(e) {
        e.preventDefault();
        $(this).closest(".accordion-group").find(".add-question-btn").each(function() {
            $(this).click();
        });
    });
    $("#que-save-create-question-btn").click(function(e) {
        e.preventDefault();
        var content = $("#que-create-question-input").val();
        if (content.trim() == "") {
            alert("Question cannot be empty");
        } else {
            var data = {content: content.trim()};
            ajaxCall(createQuestionUrl, data, createQuestion);
        }
    });

    $("body").on("click", ".remove-question-btn", function(e) {
        e.preventDefault();
        // $("#que-confirm-modal").modal("show");
        if (confirm("Are you sure")) {
            var userQuestion_id = $(this).closest(".question-row").attr("user-question-id");
            var data = {userQuestion_id: userQuestion_id};
            ajaxCall(removeQuestionUrl, data, removeQuestion);
        }
        //$("#que-confirm-modal").modal("hide");
    });

    $("body").on("click", ".from-results-remove-question-btn", function(e) {
        e.preventDefault();
        // $("#que-confirm-modal").modal("show");

        var userQuestion_id = $(this).closest(".from-results-question-row").attr("user-question-id");
        var data = {userQuestion_id: userQuestion_id};
        ajaxCall(removeQuestionUrl, data, removeFromSearchQuestion);

        //$("#que-confirm-modal").modal("hide");
    });


    $("body").on("click", ".que-more-question-info-btn", function(e) {
        var expand = $(this).text() === "More Question Details";
        if (expand) {
            e.preventDefault();
            var questionId = $(this).closest(".question-result-row").attr("question-id");
            var data = {question_id: questionId};
            ajaxCall(moreInfoQuestionUrl, data, moreInfoQuestion);
        } else {
            $(".question-result-row").find(".que-more-info-question-row").hide("slow");
        }
        $(this).text(expand ? "Less Question Details" : "More Question Details");

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
        $(".que-edit-question-submit-btn-row").hide("fast");
        $(".edit-question-input").hide("fast");
        $(".que-question-action-links").show("fast");
        $(".que-question-text").show("fast");
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
        var content = $(this).closest(".question-row").find(".que-edit-question-content").val();
        if (content.trim() == "") {
            alert("Question Content cannot be empty");
        } else {
            var user_question_id = $(this).closest(".question-row").attr("user-question-id");
            var data = {user_question_id: user_question_id,
                content: content.trim()};
            ajaxCall(editQuestionUrl, data, editQuestion);
        }
    });
}