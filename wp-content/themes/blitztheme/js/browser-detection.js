
(function($){
	jQuery.each( jQuery.browser, function( i, val ) {
	 /* $( "<div>" + i + " : <span>" + val + "</span>" )
	  .appendTo('.twitts');*/

	  if(i == 'mozilla'){
	  	$('.wpp-post-title').css({'font-size':'12px','line-height': '2'})
	  	$('.nav-top .navbar-nav>li>a').css({'font-size':'1.12em'})
	  }
	  else if(i == 'chrome'){
	  	$('.wpp-post-title').css({'font-size':'15px','line-height': '1.6'});

	  }

	});

})(jQuery);
