$(function(){
	$("#createname").bind('keyup change',pg);
})

function pg(){
	var v=$("#createname").val();
	if(v==0){
		$("#createsubmit").attr("class","ng");
		$("#createsubmit").html("Cancel");
		$("#createsubmit").removeAttr("href");
	}else{
		$("#createsubmit").attr("class","ok");
		$("#createsubmit").attr("href",v);
	}
}

function console(act,path,full,list){
	if(act=="create"){
		$(".createon").toggle(100);
		$("#createsubmit").html("Create New Page");
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

