require('./bootstrap');


$(document).ready(function () {

    $('#timeline').click(function () {
        $('.container').show();
    })


    $("#strEvent").keyup(function (e) {
        e.preventDefault();
        if ($('#strEvent').val().length >= 2) {

            var obj = JSON.parse($('#cache').val());
            var options = {
                data: obj,

                getValue: "event",

                list: {
                    match: {
                        enabled: true
                    }
                }
            };

            $("#strEvent").easyAutocomplete(options);

        }
    });
        
});