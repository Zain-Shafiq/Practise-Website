$(document).ready(function() {
    $(".scroll-link").click(function() {
        var target = $($(this).attr("href"));
        if (target.length) {
            var scrollTo = target.offset().top;
            $("html, body").animate({ scrollTop: scrollTo }, 1000);
            return false;
        }
    });
});