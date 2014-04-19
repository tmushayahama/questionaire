// ________________________________________________________________
// |-------------------------INITIALIZATIONS-----------------------|
// `````````````````````````````````````````````````````````````````

$(document).ready(function(e) {
    console.log("Loading gb_home.js....");

    tourEventHandlers();
});
function tourEventHandlers() {

    $("#que-start-tour-btn").click(function(e) {
        e.preventDefault();
        var tour = new Tour({
            backdrop: true,
            storage: false,
            steps: [
                {
                    element: "#que-project-heading",
                    title: "Project Heading and Count",
                    content: "See how many projects you have created.",
                    placement: "bottom",
                    position: "fixed"
                },
                {
                    element: "#que-create-project-panel",
                    title: "Creating a Project",
                    content: "Manage your questionnaire in projects",
                    placement: "top"
                },
                {
                    element: "#que-projects-container",
                    title: "Your Projects",
                    content: "This is where all your projects are.",
                    placement: "top"
                }
            ]}
        );
        // Initialize the tour
        tour.init();
        //Start the tour
        tour.start();
    });
}
