$(document).ready(function() {
    $('.editIdentite').on('click', function editIdentite() {
        var url = $(this).attr('data-url');
        $.get(url, function (data) {
            $('#semestre').hide();
            $('#filiere').hide();
            $('#identite').html(data);
            $('#identite').fadeIn(1000);
        });
    });

    $('.editInfoPerso').on('click', function editInfoPerso() {
        var url = $(this).attr('data-url');
        $.get(url, function (data) {
            $('#infoPerso').hide();
            $('#infoPerso').html(data);
            $('#infoPerso').fadeIn(1000);
        });
    });

    $('.editInfoSupp').on('click', function editInfoSupp() {
        var url = $(this).attr('data-url');
        $.get(url, function (data) {
            $('#infoSupp').hide();
            $('#infoSupp').html(data);
            $('#infoSupp').fadeIn(1000);
        });
    });
});