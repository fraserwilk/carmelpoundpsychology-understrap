// Add your custom JS here.

// init Scrollmagic Controller
var controller = new ScrollMagic.Controller();

(function($){ 
    
    $(document).ready(function($){

        $('article.post').each(function(){
            var post = $(this);
            var id = post.attr('id');

                // build scene
            new ScrollMagic.Scene({
                triggerElement: "#" + id,
                triggerHook: 0.7, // show, when scrolled 10% into view
                offset: 50 // move trigger to center of element
            })
            .setClassToggle("#" + id, "visible") // add class to reveal
            .addTo(controller);
        })

    }); 
})(jQuery);
    




