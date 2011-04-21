$(function(){
	$("#submit:submit").attr("disabled", "disabled");

	fit();
	$("#string").EnableTabs();
	$(window).bind('resize',fit);

	converter = new Showdown.converter();
	md();
	$("#string").bind('keyup change',md);

});

function fit(){
	var h = $(window).height() - $("#header").height();
	$("#editor").css({"height":h-72});
	$("#preview").css({"height":h-72});
}

function md(){
	var txt = $("#string").val();
	txt = converter.makeHtml(txt);
	txt = txt.replace(/(http:\/\/.*?<\/a>)/,"$1↱");
	$("#marked").html(txt);

	if(txt != ''){
		$("#submit:submit").removeAttr("disabled");
	}else{
		$("#submit:submit").attr("disabled","disabled");
	}
}
