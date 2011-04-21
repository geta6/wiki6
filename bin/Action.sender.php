<?php
switch($_POST['a']){ 
	case false:
	case "signin":?>

	<script src="lib/Message.control.js"></script>
	<div id="message">
		<div id="innermessage">
			<h1>Sign in.</h1>
				<form action="<?echo$_POST['path'];?>" method="post">
				Password: <input name="password" type="password">
				<input name="p" value="<?echo$_POST['path'];?>" type="hidden">
				<input name="a" value="signin" type="hidden">
			</form>
		</div>
	</div>

<?php	break;
	case "signout":?>

	<script src="lib/Message.control.js"></script>
	<div id="message">
		<div id="innermessage">
			<h1>Sign out?</h1>
			<form action="<?echo$_POST['path'];?>" method="post">
				<input name="signout" type="submit" value="Yes" class="button ok">
				<input name="signout" type="submit" value="No" class="button ng">
				<input name="p" value="<?echo$_POST['path'];?>" type="hidden">
				<input name="a" value="signout" type="hidden">
			</form>
		</div>
	</div>
	
<?php	break;
	case "delete":?>

	<script src="lib/Message.control.js"></script>
	<div id="message">
		<div id="innermessage">
			<h1>Delete "<?echo$_POST['path']?>"?</h1>
			<form action="<?echo$_POST['path'];?>" method="post">
				<input name="delete" type="submit" value="Yes" class="button ok">
				<input name="delete" type="submit" value="No" class="button ng">
				<input name="p" value="<?echo$_POST['path'];?>" type="hidden">
				<input name="a" value="delete" type="hidden">
			</form>
		</div>
	</div>
	
<?php	break;
	case "setting": //TODO 未実装?>

	<script src="lib/Message.control.js"></script>
	<div id="setting">
		<div id="innersetting">
			<h1>Setting</h1>
			<? $conf = json_decode(file_get_contents("../etc/setting.json")); ?>
			<div class="smaster">
				<div class="skey">Index</div>
				<div class="sval"><input type="text" value="<?echo$conf->index;?>"></div>
			</div>
			<div class="smaster">
				<div class="skey">Site Policy</div>
				<div class="sval">
					<select>
					<? switch($conf->policy){
						case 0:echo'<option value="0">public</option>';break;
						case 1:echo'<option value="1">protect</option>';break;
						case 2:echo'<option value="2">private</option>';break;
					} ?>
					</select>
				</div>
			</div>
			<div class="smaster">
				<div class="skey">Theme</div>
				<div class="sval">
					<select>
					<? switch($conf->theme){
						case 0:echo'<option value="0">public</option>';break;
						case 1:echo'<option value="1">protect</option>';break;
						case 2:echo'<option value="2">private</option>';break;
					} ?>
					</select>
				</div>
			</div>
			<form action="<?echo$_POST['path'];?>" method="post">
				<input name="setting" type="submit" value="Confirm" class="button ok">
				<input name="setting" type="submit" value="Cancel" class="button ng">
				<input name="p" value="<?echo$_POST['path'];?>" type="hidden">
				<input name="a" value="setting" type="hidden">
			</form>
		</div>
	</div>

<?php	break;
	case "history": //TODO 未実装
		$list=explode("|#|",$_POST['list']);?>

	<div id="message">
		<div id="innermessage">
			<h1>History</h1>
			<?foreach($list as $v){echo"<p>$v</p>";}?>
			<?echo$_POST['path'];?>
		</div>
	</div>

<?php	break;
	case "edit":?>

		<script src="lib/plugin/ittabs.js"></script>
		<script src="lib/plugin/markdown.js"></script>
		<script src="lib/Message.editor.js"></script>
		<div id="editor">
			<form action="<?echo$_POST['path'];?>" method="post" class="edit">
				<textarea id="string" name="string"><?echo file_get_contents("../".$_POST['full']);?></textarea>
				<input type="submit" class="ok" name="edit" value="Publish">
				<input type="submit" class="ng" name="edit" value="Cancel">
				<input name="p" value="<?echo$_POST['path'];?>" type="hidden">
				<input name="a" value="edit" type="hidden">
			</form>
		</div>
		<div id="preview">
			<div class="edit">
				<div id="marked"></div>
			</div>
		</div>

<?php } ?>
