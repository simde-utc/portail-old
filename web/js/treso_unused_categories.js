$(function() {
    $('#unused-categories-list').change(function() {
        var id = $(this).val();
        var url = $('#unused-categories-btn').attr('data-url-base');
        $('#unused-categories-btn').attr('href', url + id);
    });
    $('#unused-categories-list').change()
});