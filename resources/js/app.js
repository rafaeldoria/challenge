require('./bootstrap');


$(document).ready(function () {
    
    $(function () {
        var availableTutorials = [
            "ActionScript",
            "Bootstrap",
            "C",
            "C++",
        ];
        $("#automplete-1").autocomplete({
            source: availableTutorials
        });
    });
});