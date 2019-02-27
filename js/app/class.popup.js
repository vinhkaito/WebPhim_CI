var clsPopup = (function() {
	//INIT
	function init(){
        initEvent();
	}

	function initEvent()
	{
		$('.popup-close').click(function(){
			closeAll();	
		});	
	}


	//FUNCTIONS
	function closeAll()
	{
		TweenMax.to(('.popup'), 0, { css:{display:'none',opacity:0}} );
	}

	function open(id)
	{
		closeAll();
		TweenMax.to( $(id), 0.4, { css:{display:'block',opacity:1}} );
	}
	//RETURN
	return {
		init:init,
		closeAll:closeAll,
        open:open
	}
})();		

