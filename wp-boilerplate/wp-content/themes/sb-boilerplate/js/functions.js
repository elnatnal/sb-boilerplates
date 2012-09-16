// Functions.js
//
// Javascript behavior for the smashing boxes site
// -------------------------------------------------- //
//= require colorbox.js
//= require smashingslider.js
// -------------------------------------------------- //

(function($){})(window.jQuery);

$(document).ready(function (){

    // Homepage actions
    // -------------------------------------------------- //
    $("#smashing_slider").smashingSlider();     

    // "Lightboxes" effect
    // -------------------------------------------------- //
    
    $(".iLightbox").colorbox({ iframe:true, innerWidth:456, innerHeight:254, opacity: 0.5 });

    // Portfolio page actions
    // -------------------------------------------------- //
    $(".scrollback").click(function(e) {
        $("html, body").animate({ scrollTop: 0 }, 500);
    });
    
    // Slider functionality
    $(".portfolio-item ul li a").click(function(e) {
        
        e.preventDefault();
        
        // Store important dom elements in jQuery selectors
        var $this      = $(this),        
            $portfolio = $(this).closest(".portfolio-item"),
            $slides    = $portfolio.find("figure img"),
            newSlot    = $(this).text($(this).parent())
        ;
        
        // Set the correct marker
        $portfolio.find("a").removeClass("selected");
        $this.addClass("selected");
        
        $slides.filter(".focus").animate({ left: -10, opacity: 0 }, 250, function() {
            $slides.removeClass('focus').eq(newSlot).addClass("focus").css({ left: -10, opacity: 0 }).animate({ left: 0, opacity: 1}, 550);
        });

    });

    
    // Nav links on parent/child pages
    // -------------------------------------------------- //
    
    if ($("article.child").length > 0) {
        
        
        $("article.child").each(function(i) {
            $(this).find(".menu li").removeClass("current_page_item").eq(i).addClass("current_page_item");
        });
        
        
        $("article.child .menu a").click(function(e) {

            e.preventDefault();

            var index = $(this).parent().index()
            ,   $focus = $("article").eq(index)
            ;

            $("html, body").animate({ scrollTop : $focus.offset().top });

        });
        
    }


    // Hover effects on lists and articles 
    // -------------------------------------------------- //

    $("ul li, .home article, .blog article").hover(function() {
        $(this).parent().children("li, article").not(this).stop().animate({ opacity: 0.45 }, 200);
    }, function() {
        $(this).parent().children("li, article").stop().animate({ opacity: 1 }, 200);
    });
    


    // "Show More" effect
    // -------------------------------------------------- //

    $("header a.toggler").toggle(function() { 

        var $target = $(this).parent().find(".body"),
            height = $target.find("p").height() + 30;

        $target.animate({ height : height });
        $(this).html("Read less <em>-</em>");
        
    }, function() {
        $(this).parent().find(".body").animate({ height : "0"});
        $(this).html("Read more <em>+</em>");
    });

    $("article a.toggler").toggle(function() { 

        var $target = $(this).parent().find(".body"),
            height = $target.find("p").height() + 30;

        $target.animate({ height : height });
        $(this).html("Read less <em>-</em>");
        
    }, function() {
        $(this).parent().find(".body").animate({ height : "195px"});
        $(this).html("Read more <em>+</em>");
    });
    


    // Inline Labels
    // -------------------------------------------------- //

    $('input, textarea').each(function() {

        var label = $("label[for='" + $(this).attr("name") + "']").text();

        if($(this).val().replace(" ", "") === '') {
            $(this).val(label); 
        }
        
        $(this).on("blur, focus", function() {
            if($(this).val() === label) {
                $(this).val('');
            }
        });
        
        $(this).blur(function() {
            if($(this).val().replace(" ", "") === '') {
                $(this).val(label);
            }
        });
    });


    // Google Maps
    // -------------------------------------------------- //
    
    
    function mappit() {

        var coords    = new google.maps.LatLng(35.993470855890195, -78.9045814449463),
            loc       = window.location.origin,
            myOptions = {
                zoom      : 17,
                center    : coords,
                mapTypeId : google.maps.MapTypeId.ROADMAP
            };
        
        var map = new google.maps.Map(document.getElementById('smashing_map'), myOptions),
            infowindow = new google.maps.InfoWindow({
                content: "<strong>Smashing Boxes</strong><br/>"
                    + "<a target='_blank' href='http://maps.google.com/maps?q=334+Blackwell+Street&um=1&ie=UTF-8&hq=&hnear=0x89ace46ceeac0791:0xe025bdae06f1a0c8,334+Blackwell+St,+Durham,+NC+27701&gl=us&ei=YzE5T4yuH5ODtgfZl9zRCg&sa=X&oi=geocode_result&ct=title&resnum=1&ved=0CCQQ8gEwAA'>View full map &raquo;</a>",
                'pixelOffset' : new google.maps.Size(60, 60) 
            }),
            marker = new google.maps.Marker({													
                position: new google.maps.LatLng(35.993, -78.9044),
                map: map,
                title: "Smashing Boxes",
                icon: '../wp-content/themes/smashingboxes/images/icons/marker.png'
            });

        // Open the infowindow on click
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
        });
    }

    if (typeof google !== "undefined") {
        mappit();
    }


    // Responsive behavior
    // -------------------------------------------------- //
    
    $(".menu-primary-nav-container").click(function() {

        var self = $(this);

        if ($(window).width() <= 700) {
            self.toggleClass("open");
        }

    });
    
    // Handle viewports (This is mostly to deal with iPads);
    $(window).resize(function() {
        var viewport = $(window).width() > 700 ? "width=1300" : "width=device-width";
        $("meta[name='viewport']").attr("content", viewport);
    }).trigger("resize");

});