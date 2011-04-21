<?php
require_once "bin/Class.Init6.php";

class Wiki6 extends Init6 {

	/* ----- Printer -----*/
	
	function PrintUpdate(){
		if(UPDATE) echo'<a href="https://github.com/geta6" style="display:block;height:2em;width:100%;line-height:2em;background:#FFF588;">New version is now available.</a>';
	}
	
	function PrintTitle(){
		echo $this->conf->title." : ".$this->capt;
	}
	
	function PrintTheme(){
		$dir = opendir("usr/".$this->conf->theme);
		while($file = readdir($dir)) if(!in_array($file,array("",".","..")) && is_file("usr/".$this->conf->theme.'/'.$file)) $list[] = $file;
		sort($list);
		foreach($list as $v) echo '<link rel="stylesheet" href="usr/'.$this->conf->theme.'/'.$v.'">'."\n";
		closedir($dir);
	}
	
	function PrintHeaderGroup(){
		echo'<h1><a href="./">'.$this->conf->title.'</a></h1>'."\n\t\t\t";
		echo'<h2>'.$this->conf->subtitle.'</h2>'."\n";
	}
	
	function PrintConsole(){
		echo'<a class="nav" href="./">home</a>'."\n";
		if(LOCKED){
			echo'<a class="nav" onclick="console(\'signin\',\''.$this->page.'\')">sign in</a>'."\n";
		}else{
			echo'<a class="nav" onclick="console(\'setting\',\''.$this->page.'\')">setting</a>';
			echo'<a class="nav" onclick="console(\'signout\',\''.$this->page.'\')">sign out</a>'."\n";
		}
	}
	
	function PrintAction(){
		echo'<div id="action">';
		echo $this->ModTimeDetect();
		if(!LOCKED&&EXISTS){
			if($this->page!=$this->conf->index) echo'<a onclick="console(\'delete\',\''.$this->page.'\')">delete</a>';
			#echo'<a onclick="console(\'history\',\''.$this->page.'\',\'\',\''.implode("|#|",$this->list).'\')">history</a>';
			echo'<a onclick="console(\'edit\',\''.$this->page.'\',\''.$this->full.'\')">edit</a>';
		}
		echo'</div>';
	}
	
	function PrintSection(){
		if(EXISTS){
			include_once "lib/plugin/markdown.php";
			$str = MarkDown(file_get_contents($this->full));
			echo preg_replace('|(https*://.*?</a>)|',"$1↱",$str);
		}elseif(!LOCKED){
			echo "<script>console('edit','".$this->page."');</script>";
		}else{
			echo "<h1>Do Not Exists.</h1>";
		}
	}
	
	function PrintCreator(){
		if(!LOCKED){
			echo'
			<a style="display:block" id="createsubmit" class="ng" onclick="console(\'create\')">Create New Page</a>
			<input style="display:none" id="createname" class="createon" type="text">
			';
		}
	}
	
	function PrintNavigation(){
		$plist=get_object_vars($this->cach);
		echo"<ul>";
		foreach($plist as $k=>$v){
			if($k==$this->page){
				echo'<li>'.$v.'</li>';
			}else{
				echo'<li><a href="./'.$k.'">'.$v.'</a></li>';
			}
		}
		echo"</ul>";
	}
	
	function PrintFooter(){
		echo$this->conf->footer." | powered by <a href='https://github.com/geta6/wiki6'>Wiki6-".file_get_contents("bin/VERSION")."</a>";
	}
	
	function PrintSetting(){
		
	}

	function ModTimeDetect(){
		if(is_file($this->full)){
			$diff = time()-filemtime($this->full);
			if($diff<1) return null;
			elseif($diff<1)  return (int)($diff)." second ago";
			elseif($diff<60) return (int)($diff)." seconds ago";
			elseif($diff<60*1)  return (int)($diff/60)." minute ago";
			elseif($diff<60*60) return (int)($diff/60)." minutes ago";
			elseif($diff<60*60*1)  return (int)($diff/60/60)." hour ago";
			elseif($diff<60*60*24) return (int)($diff/60/60)." hours ago";
			elseif($diff<60*60*24*1) return (int)($diff/60/60/24)." day ago";
			elseif($diff<60*60*24*7) return (int)($diff/60/60/24)." days ago";
			else return date("F j, Y",filemtime($this->full));
		}
	}

	/* ----- Handler ----- */
	
	function FileWrite($data){
		switch(false){
		case is_dir($this->base."/".$this->page):
			mkdir($this->base."/".$this->page);
		default:
			if($data!=file_get_contents($this->full)){
				file_put_contents($this->base."/".$this->page."/".date("ymdHis").".md",$data);
				if($this->conf->cache-1 < count($this->list)){
					$delete = array_slice($this->list,$this->conf->cache-1);
					foreach($delete as $v){
						unlink($this->base."/".$this->page."/".$v);
					}
				}
			}
		}
	}

	function FileDelete(){
		foreach($this->list as $file){
			unlink($this->base."/".$this->page."/".$file);
		}
		rmdir($this->base."/".$this->page);
		$this->CacheUpdate(array($this->page,$this->capt),"del");
	}

	function FileDiff($file1,$file2){
		if(is_file($file1)&&is_file($file2)){ 
			$text = fopen($file_name,'r'); 
			for($line = 1; !feof($text); $line++){ 
				$lines = fgets($text);
				if($lines){
					print $lines;
				}
			}
			fclose($text);
		}
	}
}
