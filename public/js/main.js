
(function ($) {
    "use strict";
    
    $( function() {
        $( "#datepicker" ).datepicker();
      } );
	
	$(document).ready(function() {
        $('.username > a').on('click', function(){
            $('ul.user-dropdown').toggleClass('clicked');
        });
	   
	});
	
})(jQuery);