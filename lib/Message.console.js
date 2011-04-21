$(function(){
	$(".navon").toggle();
	$("#createname").bind('keyup change',pg);
	$("#createcancel").click(function(){
		$("#createsubmit").removeAttr("href");
		$("#createname").removeAttr("value");
		})
})

function console(act,path,full,list){
	if(act=="create"){
		$(".navon").toggle(100);
	}else{
		if(!path){ path=""; }
		if(!full){ full=""; }
		if(!list){ list=""; }
		$("#content").fadeOut(100,function(){
			$(this).load("bin/Action.sender.php",{"a":act,"path":path,"full":full,"list":list},function(){
				$(this).fadeIn(100);
			});
		});
	}
}

function pg(){
	$("#createsubmit").attr("href",$("#createname").val());
}