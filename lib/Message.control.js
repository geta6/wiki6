$(function(){
	cnt();
	$(window).bind('resize',cnt);
})

function cnt(){
	var mw = ($(window).width()-$("#message").width()) / 2;
	var mh = ($(window).height()-$("#message").height()+$("#header").height()) / 2.5;
	$("#message").css({"position":"absolute","left":mw,"top":mh});
	var sw = ($(window).width()-$("#setting").width()) / 2;
	var sh = ($(window).height()-$("#setting").height()+$("#header").height()) / 2.5;
	$("#setting").css({"position":"absolute","left":sw,"top":sh});
}