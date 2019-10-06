require('./bootstrap');


$(document).ready(function () {

    $('#timeline').click(function () {
        $('.container').show();
    })


    // $("#strEvent").keyup(function (e) {
    //     e.preventDefault();
    //     if ($('#strEvent').val().length === 2) {
    //         console.log($('#strEvent').val());

    //         $.ajax({
    //             url: '/events/autocomplete',
    //             type: 'POST',
    //             data: {
    //                 'str': $('#strEvent').val()
    //             },
    //             datatype: 'json',
    //             success: function (date) {
    //                 console.log(data);
    //             },
    //             error: function (error) {
    //                 console.log(error);
    //             }
    //         });
    //         var options = {
    //             data: ["var", "bu", "teste"]

    //         }
    //         $("#strEvent").easyAutocomplete(options);
    //     }
    // });

    // $(function () {
    //     var availableTutorials = [
    //         "ActionScript",
    //         "Bootstrap",
    //         "C",
    //         "C++",
    //     ];
    //     $("#automplete-1").autocomplete({
    //         source: availableTutorials
    //     });
    // });
});