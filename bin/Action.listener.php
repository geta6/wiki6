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
	case "history": //TODO 未実装
		$wiki6->FileDiff($_POST['p'],$_POST["string"]);
		break;
	}
	header("Location: ./".$_POST['p']);
}
?>
