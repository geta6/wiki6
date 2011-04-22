$(function(){
	$("#submit:submit").attr("disabled", "disabled");
	fit();
	$("#string").EnableTabs();
	$(window).bind('resize',fit);
	converter = new Showdown.converter();
	md();
	$("#string").bind('keyup change',md);
	$("#syntax").click(function(){syntax();});
});

function syntax(){
	if($("#syntax").attr("class")=="ok"){
		$("#syntax").attr("class","ng");
		$("#syntax").attr("value","Close");
		$("#marked").fadeOut(200,function(){
			$(this).load("lib/Syntax.html",function(){
				$(this).fadeIn(200);
			});
		});
	}else{
		md();
	}
}

function fit(){
	var h = $(window).height() - $("#header").height();
	$("#editor").css({"height":h-72});
	$("#preview").css({"height":h-72});
}

function md(){
	var txt = $("#string").val();
	txt = converter.makeHtml(txt);
	txt = txt.replace(/(https*:\/\/.*?<\/a>)/g,"$1↱");
	if($("#syntax").attr("class")=="ng"){
		$("#syntax").attr("class","ok");
		$("#syntax").attr("value","Syntax");
		$("#marked").fadeOut(200,function(){$(this).html(txt).fadeIn(200);});
	}else{
		$("#marked").html(txt);
	}
	if(txt != ''){
		$("#submit:submit").removeAttr("disabled");
	}else{
		$("#submit:submit").attr("disabled","disabled");
	}
}
