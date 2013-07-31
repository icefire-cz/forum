$(function() {

    // show the buttons
    $('#nav_up').fadeIn('slow');
    $('#nav_down').fadeIn('slow');
    $('#nav_comments').fadeIn('slow');

    var $duration = 800;

    // scroll to the bottom of the page
    $('#nav_down').click(
        function (e) {
            $('html, body').animate({
                scrollTop: $(document).height() - $(window).height()
            }, $duration);
        }
    );

    // scroll to the top of the page
    $('#nav_up').click(
        function (e) {
            $('html, body').animate({
                scrollTop: '0px'
            }, $duration);
        }
    );

    // scroll to the vanilla comments
    $("#nav_comments").click(
        function (e) {
            $('html, body').animate({
                scrollTop: $(".CommentsWrap").offset().top
            }, $duration);
        }
    );
 });
