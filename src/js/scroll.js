$(document).ready(function() {
    $("#submit").click(function() {
        $("html, body").animate(
            {
                scrollTop: $("#test").offset().top
            },
            500
        );
    });
});

$(function() {
    $("#editor").shieldEditor({
        height: 260
    });
});
