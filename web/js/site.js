$(function(){

    // form submit in textarea by Ctrl+Enter
    $('textarea').keydown(function (e) {
        if (e.ctrlKey && e.keyCode == 13) {
            $(e.target).parents('form:first').submit();
        }
    });

});

