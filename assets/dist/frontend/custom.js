function setSizes() {
	$('.mThumbnail').css('height', '');
	var thumbnailHeight = $(".mThumbnail").height();
	$(".mThumbnail").height(thumbnailHeight);
}
$('img').on('load', function() {
    setSizes();
});

$(window).resize(function() { setSizes(); });
$(document).ready(function(){
	$("#skinSwitch").click(function(){
		$("body").toggleClass("dark");
		if ($("body").hasClass("dark")) {
			document.cookie = "skin=dark";
		} else {
			document.cookie = "skin=";
		}
	});
setSizes();	
	$(".search-btn").click(function(){
		$(this).button('loading');
		$.ajax({
			url: "/ajax/search",
			type: "POST",
			data: $(".search-form").serialize(),
			success: function(data){
				
			}
		});
		$(this).button('reset');
	});
});
$(".light-off").click(function(){
    $(this).removeClass("active");
})
$(".light-off-btn").click(function(){
	$(".light-off").addClass("active");
})