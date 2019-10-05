require('./bootstrap');


$(document).ready(function () {
    $("#strEvent").keyup(function (e) {
        e.preventDefault();
        if ($('#strEvent').val().length === 2) {
            console.log($('#strEvent').val());
            
            $.ajax({
                url: '/events/autocomplete',
                type: 'POST',
                data: {'str':$('#strEvent').val()},
                datatype: 'json',
                success: function (date) {
                    console.log(data);
                },
                error: function (error) {
                    console.log(error);
                }
            });        
            var options = {
                data: ["var", "bu", "teste"]

            }
            $("#strEvent").easyAutocomplete(options);
        }
    });
    
});