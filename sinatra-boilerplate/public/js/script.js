/* Author:Jonathan Stephens, Smashing Boxes
*/

$(function() {
    $('ul.nav a').bind('click',function(event){
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollLeft: $($anchor.attr('href')).offset().left
        }, 1500,'easeInOutExpo');
        $('html, body').stop().animate({
            scrollLeft: $($anchor.attr('href')).offset().left
        }, 1000);
        event.preventDefault();
    });
});






