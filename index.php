<?php
require_once "bin/Class.Wiki6.php";
$wiki6 = new Wiki6;
require_once "bin/Action.listener.php"
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once "bin/Object.metatags.php"; ?>
</head>
<body>
<?php require_once "bin/Object.navigate.php"; ?>
<div id="content">
<?php
	if(LOCKED>1){echo"<script>console('signin');</script>";}
	else{require_once "bin/Object.contents.php";}
?>
</div>
</body>
</html>
