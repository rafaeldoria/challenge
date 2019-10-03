require('./bootstrap');


$(document).ready(function () {
    console.log("ready!");
    $("#strEvent").keyup(function () {
        console.log($('#strEvent').val());
        if ($('#strEvent').val() == 2)
        {
            console.log('return');
        }
    });
});