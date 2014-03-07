
/*----------------GLOBAL VARIABLES ---------*/
var QUESTION_ADDED_COLOR = "#999";
var QUESTION_ADDED_OUTLINE = "#EFDAA5 solid 5px";
var resultOutput = 1;
var selectedDropdown = [""];
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
    browseQuestionEventHandlers();
    addQuestionEventHandlers();
    editQuestionnaireHandlers();
    reorderQuestionsHandlers();
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
function questionBrowse(data) {
    //alert(data["question_search_results"])
    $("#que-browse-question-pane").html(data["sortcode_child"]);
    $("#que-browse-result").html(data["question_search_results"]);
}
function questionSearch(data) {
    if (data["no_results"]) {
        $("#que-question-result").html("<h1 class='text-center'>No Match Found</h1>");//"question_row" is the thing that addQuestion controller submitted
        $("#que-filters-container").hide();
        //$("#que-result-as-container").hide();
        $("#que-result-analytics-bar").hide();
    } else {
        $("#que-filters-container").show("slow");
        $("#que-result-analytics-bar").show();
        $("#que-question-result").html(data["question_search_results"]);//"question_row" is the thing that addQuestion controller submitted
        if (data["concept_dropdown"] !== null) {
            $("#que-concept-dropdown").html(data["concept_dropdown"]); //"question_row" is the thing that addQuestion controller submitted
        }
        /*if (data["tool_dropdown"] !== null) {
         $("#que-tool-dropdown").html(data["tool_dropdown"]);
         }*/
        if (data["year_dropdown"] !== null) {
            $("#que-year-dropdown").html(data["year_dropdown"]);
        }
        for (var i = 0; i < data["selected_dropdown"].length; i++) {
            // $("#" + data["selected_dropdown"][i] + " option:nth(1)").attr("selected", "selected");
            $("#" + data["selected_dropdown"][i]).parent().hide("slow");
        }
        if (data["filter_selected"] !== null) {
            $("#que-filter-selected").append(data["filter_selected"]);
        }
    }
}
function addQuestion(data) {
    $("#que-questionnaire-questions").prepend(data["question_row"]);//"question_row" is the thing that addQuestion controller submitted
    //$("#add-question-"+question_id).css("color","#999999");//the only way????
    rearrangeNumbers("#que-questionnaire-questions");
    $("#que-question-original-number").text(data["orginal_questions_count"]);
    $("#que-question-modified-number").text(data["modified_questions_count"]);
    $("#que-question-created-number").text(data["created_questions_count"]);
}
function duplicateQuestion(data) {
    $(data["question_row"]).insertAfter("#que-user-question-row-" + data["original_user_question_id"]);//"question_row" is the thing that addQuestion controller submitted
    //$("#add-question-"+question_id).css("color","#999999");//the only way????
    //$("#que-user-question-row-"data.
    rearrangeNumbers("#que-questionnaire-questions");
    $("#que-question-original-number").text(data["orginal_questions_count"]);
    $("#que-question-modified-number").text(data["modified_questions_count"]);
    $("#que-question-created-number").text(data["created_questions_count"]);
}
function createQuestion(data) {
    $("#que-create-question-input").val("");
    $('a[href="#que-questionnaire-edit-pane"]').tab('show');
    $("#que-questionnaire-questions").prepend(data["question_row"]);//"question_row" is the thing that addQuestion controller submitted
    rearrangeNumbers("#que-questionnaire-questions");
    $("#que-question-original-number").text(data["orginal_questions_count"]);
    $("#que-question-modified-number").text(data["modified_questions_count"]);
    $("#que-question-created-number").text(data["created_questions_count"]);
}
function editQuestion(data) {
    $("#que-user-question-row-" + data["user_question_id"]).find(".que-question-content")
            .text(data["content"]);
    $("#que-question-original-number").text(data["orginal_questions_count"]);
    $("#que-question-modified-number").text(data["modified_questions_count"]);
    $("#que-question-created-number").text(data["created_questions_count"]);
}
function reorderQuestion(data) {
    rearrangeNumbers("#que-questionnaire-questions");
}
function moreInfoQuestion(data) {
    var questionResultRow = $("#question-result-row-" + data["question_id"]);
    questionResultRow.find('.que-more-info-question-modification').html(data["questions_modified_container"]);
    questionResultRow.find(".que-more-info-question-row").show("slow");
}
function getUserQuestionToDelete(data) {
    $("#user-question-to-delete-modal .modal-body").html(data["user_questions_to_delete"]);
    $("#user-question-to-delete-modal").modal("show");
}
function removeQuestion(data) {
    $("#que-user-question-row-" + data["user_question_id"]).remove();
    rearrangeNumbers("#que-questionnaire-questions");
    $("#que-question-original-number").text(data["orginal_questions_count"]);
    $("#que-question-modified-number").text(data["modified_questions_count"]);
    $("#que-question-created-number").text(data["created_questions_count"]);
}
function removeFromSearchQuestion(data) {
    $("#que-user-question-row-" + data["user_question_id"]).remove();
    $("#from-results-remove-user-question-row-" + data["user_question_id"]).remove();
    if ($(".from-results-question-row").length == 0) {
        $("#user-question-to-delete-modal").modal("hide");
    }
    rearrangeNumbers("#que-questionnaire-questions");
    $("#que-question-original-number").text(data["orginal_questions_count"]);
    $("#que-question-modified-number").text(data["modified_questions_count"]);
    $("#que-question-created-number").text(data["created_questions_count"]);
}
function rearrangeNumbers(id) {
    var children = $(id).children();
    for (var i = 0; i < children.length; i++) {
        $(children[i]).find(".count").text(i + 1);
    }
}
function incrementNumber(id) {
    rearrangeNumbers(id);
    var originalQuestions = parseInt($(id).text()) + 1;
    $(id).text(originalQuestions);
}
function decrementNumber(id) {
    rearrangeNumbers(id);
    var originalQuestions = parseInt($(id).text()) - 1;
    $(id).text(originalQuestions);
}
function  browseQuestionEventHandlers() {
    $("body").on("click", ".que-sortcode-child", function(e) {
        e.preventDefault();
        data = {parent_code: $(this).text().trim()};
        ajaxCall(questionBrowseUrl, data, questionBrowse)
    });

}
function searchEventHandlers() {
    $("#que-question-keyword-search-btn").click(function(e) {
        e.preventDefault();
        var keyword = $("#que-question-keyword-search-input").val().trim();
        var sortId = $("#que-sort-question-result-selector").find(":selected").attr("value");
        var order = $("#que-sort-order-selector").find(":selected").attr("value");
        selectedDropdown = [""];
        // if (keyword != "") {
        var data = {"keyword": keyword,
            sort_id: sortId,
            order: order,
            "year": null,
            "concept": null,
            // "tool": null,
            "selected_dropdown": selectedDropdown,
            result_output: resultOutput};
        ajaxCall(questionKeywordSearchUrl, data, questionSearch);
        $("#que-filter-selected").children().each(function(e) {
            $(this).remove();
        });
        //$("#que-question-tool-dropdown").parent().show();
        $("#que-question-concept-dropdown").parent().show();
        $("#que-question-year-dropdown").parent().show();
        //  }
    });
    $("#que-clear-search-btn").click(function(e) {
        $("#que-question-keyword-search-input").val("");
        $("#que-question-keyword-search-btn").click();
    });

    $("body").on("change", "#que-question-concept-dropdown, #que-question-year-dropdown", function(e) {
        e.preventDefault();
        var concept = $("#que-question-concept-dropdown").val().trim();
        var year = $("#que-question-year-dropdown").val().trim();
        var sortId = $("#que-sort-question-result-selector").find(":selected").attr("value");
        var order = $("#que-sort-order-selector").find(":selected").attr("value");

//var tool = $("#que-question-tool-dropdown").val().trim();
        //alert(tool)
        var keyword = $("#que-question-keyword-search-input").val().trim();
        selectedDropdown.push($(this).attr("id"));
        if (concept != "" || year != "") {
            var data = {keyword: keyword,
                sort_id: sortId,
                order: order,
                concept: concept,
                year: year,
                // tool: tool,
                result_output: resultOutput,
                selected_dropdown: selectedDropdown,
                selected_filter_type: $(this).attr("filter-type"),
                selected_filter: $(this).val()};
            ajaxCall(questionKeywordSearchUrl, data, questionSearch);
        }
    });

    $("#que-sort-question-result-selector, #que-sort-order-selector").change(function(e) {
        e.preventDefault();
        var sortId = $("#que-sort-question-result-selector").find(":selected").attr("value");
        var order = $("#que-sort-order-selector").find(":selected").attr("value");
        var concept = $("#que-question-concept-dropdown").val().trim();
        var year = $("#que-question-year-dropdown").val().trim();
        //var tool = $("#que-question-tool-dropdown").val().trim();
        //alert(tool)
        var keyword = $("#que-question-keyword-search-input").val().trim();
        var data = {keyword: keyword,
            sort_id: sortId,
            order: order,
            concept: concept,
            year: year,
            // tool: tool,
            result_output: resultOutput,
            selected_dropdown: selectedDropdown};
        ajaxCall(questionKeywordSearchUrl, data, questionSearch);
    });
    $("body").on("click", ".que-remove-filter", function(e) {
        e.preventDefault();
        var filterType = parseInt($(this).closest(".que-selected-filter-row").attr("selected-filter-id"));
        var concept = $("#que-question-concept-dropdown").val().trim();
        var year = $("#que-question-year-dropdown").val().trim();
        // var tool = $("#que-question-tool-dropdown").val().trim();
        switch (filterType) {
            /*case 1:
             tool = null;
             selectedDropdown.splice(selectedDropdown.indexOf("que-question-tool-dropdown"), 1);
             $("#que-question-tool-dropdown").parent().show("slow");
             break;*/
            case 2:
                concept = null;
                selectedDropdown.splice(selectedDropdown.indexOf("que-question-concept-dropdown"), 1);
                $("#que-question-concept-dropdown").parent().show("slow");
                break;
            case 3:
                year = null;
                $("#que-question-year-dropdown").parent().show("slow");
                selectedDropdown.splice(selectedDropdown.indexOf("que-question-year-dropdown"), 1);
                break;
        }
        //alert(selectedDropdown);
        var keyword = $("#que-question-keyword-search-input").val().trim();
        if (concept != "" || year != "") {
            var data = {keyword: keyword,
                concept: concept,
                year: year,
                /// tool: tool,
                result_output: resultOutput,
                selected_dropdown: selectedDropdown,
                selected_filter_type: null,
                selected_filter: null};
            ajaxCall(questionKeywordSearchUrl, data, questionSearch);
            $(this).closest(".que-selected-filter-row").remove();
        }
    });

    $(".que-result-as").click(function(e) {
        e.preventDefault();
        var concept = $("#que-question-concept-dropdown").val().trim();
        var year = $("#que-question-year-dropdown").val().trim();
        var sortId = $("#que-sort-question-result-selector").find(":selected").attr("value");
        var order = $("#que-sort-order-selector").find(":selected").attr("value");

// var tool = $("#que-question-tool-dropdown").val().trim();
        //alert(tool)
        var keyword = $("#que-question-keyword-search-input").val().trim();
        resultOutput = $(this).attr("result-output");
        //if (concept != "" || year != "" || tool != "") {
        var data = {keyword: keyword,
            sort_id: sortId,
            order: order,
            concept: concept,
            year: year,
            //tool: tool,
            result_output: resultOutput,
            selected_dropdown: selectedDropdown};
        ajaxCall(questionKeywordSearchUrl, data, questionSearch);
        //  }
        $(".que-result-as").removeClass("que-btn-grey-1");
        $(this).addClass("que-btn-grey-1");
    });
    $("#que-questionnaire-keyword-search-btn").click(function(e) {
        e.preventDefault();
        var keyword = $("#que-questionnaire-keyword-search-input").val().trim();
        if (keyword != "") {
            var data = {"keyword": keyword};
            ajaxCall(questionnaireKeywordSearchUrl, data, questionnaireSearch);
        }
    });
    $("#que-search-questionnaire-from-q-btn").click(function(e) {
        e.preventDefault();
        var data = $("#search-questionnaire-form-from-q").serialize();
        ajaxCall(questionnaireSearchFromQUrl, data, questionnaireSearch);
    });
    $("#que-search-questionnaire-from-cy-btn").click(function(e) {
        e.preventDefault();
        var data = $("#search-questionnaire-form-from-cy").serialize();
        ajaxCall(questionnaireSearchFromCYUrl, data, questionnaireSearch);
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
            $(this).attr("que-action", "added");
            $(this).html("<i class='icon-minus-sign'></i> Added");
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
    $("body").on("click", ".que-remove-question-btn", function(e) {
        e.preventDefault();
        // $("#que-confirm-modal").modal("show");
        if (confirm("Are you sure")) {
            var userQuestion_id = $(this).closest(".question-row").attr("user-question-id");
            var data = {userQuestion_id: userQuestion_id};
            ajaxCall(removeQuestionUrl, data, removeQuestion);
        }
        //$("#que-confirm-modal").modal("hide");
    });

    $("body").on("click", ".que-duplicate-question-btn", function(e) {
        e.preventDefault();
        var userQuestion_id = $(this).closest(".question-row").attr("user-question-id");
        var data = {user_question_id: userQuestion_id};
        ajaxCall(duplicateQuestionUrl, data, duplicateQuestion);

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
        var expand = $(this).text() === "Show Modifications";
        if (expand) {
            e.preventDefault();
            var questionId = $(this).closest(".question-result-row").attr("question-id");
            var data = {question_id: questionId};
            ajaxCall(moreInfoQuestionUrl, data, moreInfoQuestion);
        } else {
            $(".question-result-row").find(".que-more-info-question-row").hide("slow");
        }
        $(this).text(expand ? "Hide Modifications" : "Show Modifications");
    });
}

function editQuestionnaireHandlers() {
    $('#que-questionnaire-activity-nav a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });


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
                .text($(this).closest(".question-row").find(".que-question-content").text());
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
function getUserQuestionIds(parent) {
    var result = [];
    $(parent).children().each(function() {
        result.push($(this).attr("user-question-id"));
    });
    return result;
}
function reorderQuestionsHandlers() {
    $("#que-reorder-questions-btn").click(function(e) {
        e.preventDefault();
        if ($(this).attr("que-action") == "reorder") {
            $(this).attr("que-action", "done");
            $(this).text("Done Reordering")
            $("#que-reorder-questions-cancel-btn").show();
            $("#que-questionnaire-questions").sortable();
            $("#que-questionnaire-questions").disableSelection();
            $(".que-footer").hide();
            $(".que-grab-me").show();
            $(".question-row").addClass("que-sortable");
        } else {
            var data = {question_ids: getUserQuestionIds("#que-questionnaire-questions")};
            ajaxCall(reorderQuestionUrl, data, reorderQuestion);
            $(this).attr("que-action", "reorder");
            $(this).text("eorder")
            $("#que-reorder-questions-cancel-btn").hide();
            $("#que-questionnaire-questions").sortable("destroy"); //call widget-function destroy
            $('#que-questionnaire-questions').disableSelection('disabled');
            $('#que-questionnaire-questions').unbind('click');
            $('#que-questionnaire-questions').unbind('mousedown');
            $('#que-questionnaire-questions').unbind('mouseup');
            $('#que-questionnaire-questions').unbind('selectstart');
            $(".que-question-action-links").show();
            $(".que-grab-me").hide();
            $(".question-row").removeClass("que-sortable");
        }
    });
    $('#que-reorder-questions-cancel-btn').click(function() {
        location.reload();
    });
}











