jQuery(document).ready(function($) {
    var updateCss = function() { $("#sunset_css").val( editor.getSession().getValue() ) };
    $('#save-custom-css-form').submit( updateCss );

});

var editor = ace.edit("customCss");
editor.setTheme("ace/theme/monokai");
editor.session.setMode("ace/mode/css");
