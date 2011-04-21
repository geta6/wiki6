<script src="lib/Message.control.js"></script>

<?php
switch($_POST['a']){
	case false:
	case "signin":?>

	<div id="message">
		<div id="innermessage">
			<h1>Sign in.</h1>
				<form action="<?php echo$_POST['path'];?>" method="post">
				Password: <input name="password" type="password">
				<input name="p" value="<?php echo$_POST['path'];?>" type="hidden">
				<input name="a" value="signin" type="hidden">
			</form>
		</div>
	</div>

<?php	break;
	case "signout":?>

	<div id="message">
		<div id="innermessage">
			<h1>Sign out?</h1>
			<form action="<?php echo$_POST['path'];?>" method="post">
				<input name="signout" type="submit" value="Yes" class="button ok">
				<input name="signout" type="submit" value="No" class="button ng">
				<input name="p" value="<?php echo$_POST['path'];?>" type="hidden">
				<input name="a" value="signout" type="hidden">
			</form>
		</div>
	</div>
	
<?php	break;
	case "delete":?>

	<div id="message">
		<div id="innermessage">
			<h1>Delete "<?php echo$_POST['path']?>"?</h1>
			<form action="<?php echo$_POST['path'];?>" method="post">
				<input name="delete" type="submit" value="Yes" class="button ok">
				<input name="delete" type="submit" value="No" class="button ng">
				<input name="p" value="<?php echo$_POST['path'];?>" type="hidden">
				<input name="a" value="delete" type="hidden">
			</form>
		</div>
	</div>
	
<?php	break;
	case "setting": ?>

	<script src="lib/Message.console.js"></script>
	<div id="setting">
		<div id="innersetting">
			<h1>Setting</h1>
			<?php $conf = json_decode(file_get_contents("../etc/setting.json")); ?>
			<form action="<?php echo$_POST['path'];?>" method="post">
				<?php
				foreach($conf as $k=>$v){
					echo '<div class="smaster">';
					switch($k){
					case "index":
						echo '<div class="skey">Index Page Name</div>';
						echo '<div class="sval"><input type="text" name="index" value="'.$v.'"></div>';
						break;
					case "policy":
						echo '<div class="skey">Site Policy</div>';
						echo '<div class="sval" name="policy"><select name="policy">';
						echo'<option value="0"'.($v==0?" selected":null).'>public</option>';
						echo'<option value="1"'.($v==1?" selected":null).'>protected</option>';
						echo'<option value="2"'.($v==2?" selected":null).'>private</option>';
						echo '</select></div>';
						break;
					case "cache":
						echo '<div class="skey">Cache Number</div>';
						echo '<div class="sval"><input type="number" name="cache" value="'.$v.'"></div>';
						break;
					case "theme":
						echo '<div class="skey">Site Theme</div>';
						echo '<div class="sval"><select name="theme">';
						$dir = opendir("../usr");
						while($theme = readdir($dir)) if(!in_array($theme,array("",".","..")))
							echo '<option value='.$theme.($theme==$v?" selected":null).'>'.$theme.'</option>';
						echo '</select></div>';
						break;
					case "password": //if value, check one more
						echo '<div class="skey">Change Password<br><span style="display:none;" id="mspassword" class="cnpassword">confirm(more than 6)</span></div>';
						echo '<div class="sval" id="vlpassword">
							<input type="password" id="stpassword" name="password">
							<input style="display:none;font-family:monospace;" type="password" id="cnpassword" class="cnpassword">
							</div>';
						echo '<input name="prepass" type="hidden" value="'.$v.'">';
						break;
					case "title":
						echo '<div class="skey">Site Title</div>';
						echo '<div class="sval"><input type="text" name="title" value="'.$v.'"></div>';
						break;
					case "subtitle":
						echo '<div class="skey">Site Subtitle</div>';
						echo '<div class="sval"><input type="text" name="subtitle" value="'.$v.'"></div>';
						break;
					case "footer":
						echo '<div class="skey">Footer Text</div>';
						echo '<div class="sval"><input type="text" name="footer" value="'.$v.'"></div>';
						break;
					case "checkupdate":
						echo '<div class="skey">Update Notification</div>';
						echo '<div class="sval"><select name="checkupdate">';
					 	$v0=$v==0?" selected":null;
					 	$v1=$v==1?" selected":null;
						echo '<option value="1"'.$v1.'>on</option>';
						echo '<option value="0"'.$v0.'>off</option>';
						echo '</select></div>';
						break;
					}
					echo '</div>';
				}
				?>
				<br>
				<input name="setting" id="stsubmit" type="submit" value="Confirm" class="button ok">
				<input name="setting" id="stcancel" type="submit" value="Cancel" class="button ng">
				<input name="p" value="<?php echo$_POST['path'];?>" type="hidden">
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
			<?php foreach($list as $v){echo"<p>$v</p>";}?>
			<?php echo$_POST['path'];?>
		</div>
	</div>

<?php	break;
	case "edit":?>

		<script src="lib/plugin/ittabs.js"></script>
		<script src="lib/plugin/markdown.js"></script>
		<script src="lib/Message.editor.js"></script>
		<div id="editor">
			<form action="<?php echo$_POST['path'];?>" method="post" class="edit">
				<textarea id="string" name="string"><?php echo file_get_contents("../".$_POST['full']);?></textarea>
				<input type="submit" class="ok" name="edit" value="Publish">
				<input type="submit" class="ng" name="edit" value="Cancel">
				<input name="p" value="<?php echo$_POST['path'];?>" type="hidden">
				<input name="a" value="edit" type="hidden">
			</form>
		</div>
		<div id="preview">
			<div class="edit">
				<div id="marked"></div>
			</div>
		</div>

<?php } ?>
