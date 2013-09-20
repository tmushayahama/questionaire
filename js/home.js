/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
	console.log("loading home.js...");
	rearrangeProject();
});
function rearrangeProject() {
	var studies = $("#projects").children();
	for (var i = 0; i < studies.length; i += 2) {
		studies.slice(i, i + 2).wrapAll('<div class="row-fluid"></div>');
	}
}



