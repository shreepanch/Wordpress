jQuery(document).ready(function($){

/* MEan Menu */
  jQuery('#main-nav').meanmenu({
      meanMenuContainer: '.main-navigation-holder',
      meanScreenWidth:"767"
    });

/* slick slider starts */

$('.main-blog-slider').slick();

jQuery(".search-box").hide();

jQuery(".search-btn").click(function(e) {
          
         
        var parent_element = $(this).parent();
        parent_element.children('.search-box').slideToggle('slow');
        // $('.has-children').toggleClass('open');
        parent_element.toggleClass('open');
        e.preventDefault();
        
});

/* header search form ends */

/* Scroll to section */
// Go to top.
  var $scroll_obj = $( '#btn-gotop' );
  $( window ).scroll(function(){
    if ( $( this ).scrollTop() > 100 ) {
      $scroll_obj.fadeIn();
    } else {
      $scroll_obj.fadeOut();
    }
  });

  $scroll_obj.click(function(){
    $( 'html, body' ).animate( { scrollTop: 0 }, 600 );
    return false;
  });  

});