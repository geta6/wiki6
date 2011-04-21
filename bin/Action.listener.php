<?php
if(isset($_POST[Wiki6::ACT])){
	switch($_POST[Wiki6::ACT]){
	case "signin":
		$wiki6->ChkSession($_POST['password']);
		break;
	case "signout":
		if($_POST["signout"]=="Yes") $wiki6->EndSession();
		break;
	case "edit":
		if($_POST["edit"]=="Publish") $wiki6->FileWrite($_POST["string"]);
		break;
	case "delete":
		if($_POST["delete"]=="Yes") $wiki6->FileDelete();
		header("Location: ./");
		exit;
	case "setting":
		$p=$_POST["p"];
		unset($_POST["p"]);
		unset($_POST["a"]);
		unset($_POST["setting"]);
		$_POST["password"]=($_POST["password"]=="")?$_POST["prepass"]:hash("sha512",$_POST["password"]);
		unset($_POST["prepass"]);
		file_put_contents("etc/setting.json",json_encode($_POST));
		$_POST["p"]=$p;
		break;
	case "history": //TODO 未実装
		$wiki6->FileDiff($_POST['p'],$_POST["string"]);
		break;
	}
	header("Location: ./".$_POST['p']);
}
?>
