$(document).ready(function() {
    $('#identite-form').hide();
    $('#infoPerso-form').hide();
    $('#infoSupp-form').hide();
    $('.editIdentite').on('click', function editIdentite() {
        if($('#identite-form').is(':hidden')) {
            var url = $(this).attr('data-url');
            $.get(url, function (data) {
                $('#semestre').hide();
                $('#filiere').hide();
                $('#identite').hide();
                $('#identite-form').html(data);
                $('#identite-form').fadeIn(1000);
            });
        } else {
            $('#identite-form').hide();
            $('#identite').fadeIn(1000);
            $('#semestre').fadeIn(1000);
            $('#filiere').fadeIn(1000);
        }

    });

    $('.editInfoPerso').on('click', function editInfoPerso() {
        if($('#infoPerso-form').is(':hidden')) {
            var url = $(this).attr('data-url');
            $.get(url, function (data) {
                $('#infoPerso').hide();
                $('#infoPerso-form').hide();
                $('#infoPerso-form').html(data);
                $('#infoPerso-form').fadeIn(1000);
            });
        } else {
            $('#infoPerso-form').hide();
            $('#infoPerso').fadeIn(1000);
        }
    });

    $('.editInfoSupp').on('click', function editInfoSupp() {
        if($('#infoSupp-form').is(':hidden')) {
            var url = $(this).attr('data-url');
            $.get(url, function (data) {
                $('#infoSupp').hide();
                $('#infoSupp-form').hide();
                $('#infoSupp-form').html(data);
                $('#infoSupp-form').fadeIn(1000);
            });
        } else {
            $('#infoSupp-form').hide();
            $('#infoSupp').fadeIn(1000);
        }
    });
});
