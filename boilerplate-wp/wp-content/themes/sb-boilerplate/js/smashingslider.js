// A quick plugin to handle a subtle fade and swipe from left to right


// ------------------------------------- //
// jQuery Smashing Slider
// ------------------------------------- //
// Description: The plugin for the Smashing Boxes Homepage
// Version: 0.1.0
// Author: Nate Hunzaker
// ------------------------------------- //

;(function ( $, window, document, undefined ) {
    
    var pluginName = 'smashingSlider',
        defaults   = {
            analog_navigation: true,
            digital_navigation: false
        };

    function Plugin( element, options ) {
        this.element = element;
        this.options = $.extend( {}, defaults, options) ;
        
        this._defaults = defaults;
        this._name = pluginName;
        
        this.init();
    }
    
    Plugin.prototype.init = function () {
        
        // Setup ------------------------------------------------------------------------------------------- //

        var $element = $(this.element),
            $nav = $("<div id='slider-controller'></div>"),
            slides = $element.children(".slide").map(function() {
                return $(this).attr("data-class");
            });

        // Setup Controls ----------------------------------------------------------------------------- //

        if (this.options.analog_navigation) {
            $nav.append("<span class='previous'></span><span class='next'></span>");
        }

        if (this.options.digital_navigation) {
            $nav.append("<menu id='slider-navigation'><ul></ul.</menu>");
            $element.children(".slide").each(function(d) {
                $("#slider-navigation ul").append("<li>" + (++d) +"</li>");
            });
        }
        
        $element.before($nav);
        

        // Preload Images ------------------------------------------------------------------------------ //
        
        var $dummy = $element.clone(false),
            classes = $dummy.children(".slide").map(function() {
                return $(this).attr("data-class");
            });

        $.each(classes, function() {    
            
            $element.attr("class", this);
            
            var background = (new Image()).src = $element.css("background-image").replace(/(url\(|\))/ig, ""),
                feature = (new Image()).src = $dummy.find(".feature a img").attr("src");

        });
                
        // The Transitioning Function ----------------------------------------------------------- //
        
        function phaseShift(instruction) {
            
            var $slides = $element.children('.slide'),
            $selected = $element.children(".selected"),
            newSelection = {};
            
            // Are we dealing with a string?
            if (typeof instruction === "string") {

                // yes: take analog input

                switch(instruction) {
                case "next" : 
                    newSelection = $selected.removeClass("selected").next().addClass("selected"); 
                    if (newSelection.length === 0) {
                        $slides.first().addClass('selected');
                    }
                    break;

                case "previous":
                    newSelection = $selected.removeClass("selected").prev().addClass("selected"); 
                    if (newSelection.length === 0) {
                        $slides.last().addClass('selected');
                    }
                    break;

                default:
                    $slides.removeClass("selected").first().addClass("selected"); 
                    break;
                }

            } else {

                // no - take digital input

                $selected.removeClass("selected");
                newSelection = $slides.eq(instruction).addClass("selected"); 
            }
            
            var slideClass = $element.children(".selected").attr("data-class");
            
            // Swap Classes
            $element.removeClass(this.prevState).addClass(slideClass);
            
            // Mark our position within this function *and* on the slider
            this.prevState = slideClass;
            var selectedPos = $element.children(".slide.selected").index();
            $("#slider-navigation ul li").removeClass("selected").eq(selectedPos).addClass("selected");
            
            // Invert color scheme?
            if ($element.children(".selected").attr("data-inverted") === "true") {
                $("body").addClass("inverted");
            } else {
                $("body").removeClass("inverted");
            }
            
            // Gradual fadeswipe to hero
            $element.css({ opacity: 0, marginLeft: 0 }).animate({ opacity : 1, marginLeft: 0 }, 750);
            $element.children(".selected").children(".feature").css({ opacity: 0, right: "-=20px"}).animate({ opacity: 1, right: "+=20px"}, 500);
            
        }
        

        // Arrow input
        $nav.children(".next").click(function(e){
            phaseShift("next");
        });

        $nav.children(".previous").click(function(e){
            phaseShift("previous");
        });

        // Navigation Input
        $("#slider-navigation ul li").click(function(e){
            phaseShift($(this).index());
        });

        phaseShift(0);

    };

    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new Plugin( this, options ));
            }
        });
    };

})(jQuery, window, document);
