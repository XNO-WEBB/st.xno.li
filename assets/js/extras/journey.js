$(function(){
	$(".info-row").click(function(){
		$(this).children(".close-j").toggleClass("open-j", 300, "easeInOutSine");
	});
});