// ________________________________________________________________
// |-------------------------INITIALIZATIONS-----------------------|
// `````````````````````````````````````````````````````````````````

$(document).ready(function(e) {
    console.log("Loading gb_home.js....");

    tourEventHandlers();
});
function tourEventHandlers() {

    $("#gb-start-tour-btn").click(function(e) {
        e.preventDefault();
        var tour = new Tour({
            backdrop: true,
            storage: false,
            steps: [
                {
                    element: "#gb-topbar",
                    title: "Site Navigation",
                    content: "Easy to use navbar. Navigate to other pages.",
                    placement: "bottom",
                    position: "fixed"
                },
                {
                    element: "#gb-instruments-panel",
                    title: "Instruments",
                    content: "Define you skills, goals and promises",
                    placement: "top"
                },
                {
                    element: "#gb-applications-panel",
                    title: "Applications",
                    content: "Apply your skills and goals using these apps",
                    placement: "top"
                },
                {
                    element: "#gb-connections-panel",
                    title: "Connections",
                    content: "Connect to people. Share with your friends,\n\
                        family, followers and the public",
                    placement: "bottom"
                },
                {
                    element: "#gb-navbar-search",
                    title: "Skill Section Search",
                    content: "Search anything you want. First select the search type.",
                    placement: "bottom"
                },
                {
                    element: "#gb-home-activity",
                    title: "Recent Activities",
                    content: "Recent activities of people in your connections or activities shared publicly",
                    placement: "top"
                },
                {
                    element: "#gb-add-people-box",
                    title: "Add More People",
                    content: "Add more people to your connections",
                    placement: "left"
                }
            ]}
        );
        // Initialize the tour
        tour.init();
        //Start the tour
        tour.start();
    });
}
