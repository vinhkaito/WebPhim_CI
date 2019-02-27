// JavaScript Document
var clsResponsize = (function() {
	// PARAMATER
	var setting = {
		font	:	13,
		w		:	1366,
		h		:	925
	}
	
	// INIT
	function init(){
		respone();
		$(window).resize(function(e) {
			respone();
		});
	}

	// RESPONE
	function respone(){
       var h = $(window).height();
		var f = (h*setting.font)/setting.h;
		$('body').css('font-size', f + 'px' );
	}
	
	// FUNCTION

	// RETURN
	return {
		init:init,
		respone:respone
	}
})();		
