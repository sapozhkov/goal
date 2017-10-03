$(function(){

    // form submit in textarea by Ctrl+Enter
    $('textarea').keydown(function (e) {
        if (e.ctrlKey && e.keyCode == 13) {
            $(e.target).parents('form:first').submit();
        }
    });

    $('.js_goal_message_field').focus(function () {
        if ( $(this).attr('rows') == 2 )
            $(this).attr('rows', 5);
    })

});

