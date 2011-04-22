$(function(){
	$("#createname").bind('keyup change',pg);
	$("#stpassword").bind('keyup change',st);
	$("#cnpassword").bind('keyup change',st);
})

function st(){
	var v = document.getElementById("stpassword").value.length;
	if($("#stpassword").val()!=0){
		$("#vlpassword").animate({"height":"5em"});
		$(".cnpassword").fadeIn();
		if(v<6){
			$("#mspassword").html("more than 6 chars");
			$(".cnpassword").css({"color":"red"});
			$("#stsubmit").attr("disabled","disabled");
			$("#stsubmit").attr("class","ng");
		}else if($("#stpassword").val()!=$("#cnpassword").val()){
			$("#mspassword").html("cannot confirm");
			$(".cnpassword").css({"color":"red"});
			$("#stsubmit").attr("disabled","disabled");
			$("#stsubmit").attr("class","ng");
		}else{
			$("#mspassword").html("confirmed");
			$(".cnpassword").css({"color":"green"});
			$("#stsubmit").removeAttr("disabled");
			$("#stsubmit").attr("class","ok");
		}
	}else{
		$("#vlpassword").animate({"height":"2.5em"});
		$(".cnpassword").fadeOut();
		$("#stsubmit").removeAttr("disabled");
		$("#stsubmit").attr("class","ok");
	}
}

function pg(){
	var v=$("#createname").val();
	if(v==0){
		$("#createsubmit").attr("class","ng");
		$("#createsubmit").html("Cancel");
		$("#createsubmit").removeAttr("href");
	}else{
		$("#createsubmit").attr("class","ok");
		$("#createsubmit").html("Create New Page");
		$("#createsubmit").attr("href",v);
	}
}

function console(act,path,full,list){
	if(act=="create"){
		$(".createon").toggle(200);
		if($("#createsubmit").html()=="Create New Page"){
			$("#createsubmit").html("Cancel");
		}else{
			$("#createsubmit").html("Create New Page");
		}
	}else{
		if(!path){ path=""; }
		if(!full){ full=""; }
		if(!list){ list=""; }
		$("#content").fadeOut(200,function(){
			$(this).load("bin/Action.sender.php",{"a":act,"path":path,"full":full,"list":list},function(){
				$(this).fadeIn(200);
			});
		});
	}
}
