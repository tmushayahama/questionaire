/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
	console.log("loading home.js...");
	rearrangeProject();
	createNewProject();
});
function rearrangeProject() {
	var studies = $("#projects").children();
	for (var i = 0; i < studies.length; i += 2) {
		studies.slice(i, i + 2).wrapAll('<div class="row-fluid"></div>');
	}
}
function createNewProject() {
	$("#que-project-add-btn").click(function() {
		$(this).slideUp();
		//$(this).parent().find(".new-project-form").hide();
		$(this).parent().find(".new-project-form").slideDown();
	});
	$("#que-btn-close-project-form").click(function() {
		$(".new-project-form").slideUp();
		$("#que-project-add-btn").slideDown();
	});
	
}

