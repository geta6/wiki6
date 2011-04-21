<?php
/**
 *	Class only for initialize.
 *	Extended class only use part of varables.
 *
 *	@package	Wiki6
 *	@author		geta6 <geta6@geta6.net>
 *	@since		PHP 5.3.3
 */
abstract class Init6 {

	// viewing file path
	protected $full;			//full path (merge variables)
	protected $base = 'var';	//base path
	protected $page;			//folder path
	protected $list;			//revisions list
	protected $late; 			//latest of list named date format
	protected $capt;			//caption (first heading string)

	// setting values
	protected $conf;			//setting.json decoded
	protected $pass;			//entered password
	protected $cach;			//cache.json decoded

	// determine Wiki6's action
	public $EXISTS = false;		//Entered address is valid?
	public $SIGNED = false;		//Are you signed in?
	public $POLICY = "public";	//This wiki's policy.
	
	// GET vars configuration
	const KEY = "p";			//$_GET[KEY] = request page name
	const ACT = "a";			//$_GET[ACT] = action page name
	const ERR = "e";			//$_GET[KEY] = error handling

	// action name configuration
	const ADD = "Create";		//create a page
	const PUB = "Publish";		//overwrite the page
	const DEL = "Delete";		//delete the page

	function __construct(){
		$this->IniSession();
		$this->conf = json_decode(file_get_contents("etc/setting.json"));
		$this->cach = json_decode(file_get_contents("etc/cache.json"));
		define("EXISTS",$this->DetectPath());
		$this->ChkSession()?define("LOCKED",0):define("LOCKED",$this->conf->policy);
		if($this->conf->checkupdate){
			$curl=curl_init("http://dev.geta6.net/release/wiki6");
			curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);
			$current=file_get_contents("bin/VERSION");
			define("UPDATE",(float)$current>=(float)curl_exec($curl)?false:true);
		}else{
			define("UPDATE",false);
		}
	}

	/* ----- Detect ----- */
	
	private function DetectPath(){
		if(!isset($_GET[self::KEY])) $_GET[self::KEY] = $this->conf->index;
		$this->page = $_GET[self::KEY];
		$this->list = $this->DetectPaths();
		rsort($this->list);
		$this->late = $this->list[0];
		$this->full = $this->base."/".$this->page."/".$this->late;
		$this->capt = $this->DetectCaption();
		return is_file($this->full)?true:false;
	}

	private function DetectPaths($name = null){
		switch(true){
		case is_dir($this->base."/".$this->page):
			$dir = opendir($this->base."/".$this->page);
			while($file = readdir($dir)) if(!in_array($file,array("",".",".."))) $list[] = $file;
		case is_file(isset($list)?$list:null):
			closedir($dir);
			break;
		default:
			$list=array("");
		}
		return $list;
	}

	private function DetectCaption(){
		if(is_file($this->full)){
			$handle = fopen($this->full,'r');
			for($line=1;!feof($handle);$line++) if(preg_match("/^#+([^\r]*)/",fgets($handle),$match)) break;
			$newcap = array($this->page => isset($match[1])?trim($match[1]):$this->page);
			$this->CacheUpdate($newcap);
			return $newcap[$this->page];
		}else{
			return null;
		}
	}

	/* ----- Cache ----- */
	
	protected function CacheUpdate($cap,$del=null){
		$cache=get_object_vars($this->cach);
		/* EXISTS => Update or Delete */
		if(array_key_exists($this->page,$cache)){
			if(!is_null($del)){
				unset($cache[$this->page]);
			}elseif($cap[$this->page] != $cache[$this->page]){
				$cache[$this->page] = $cap[$this->page];
			}
		/* NO-EXITST => Create */
		}else{
			$cache = array_merge($cache,$cap);
		}
		$index=array($this->conf->index => $cache[$this->conf->index]);
		unset($cache[$this->conf->index]);
		asort($cache);
		$cache = array_merge($index,$cache);
		file_put_contents("etc/cache.json",json_encode($cache));
		$this->cach = json_decode(file_get_contents("etc/cache.json"));
	}

	/* ----- Session ----- */

	public function IniSession(){
		session_set_cookie_params(3600);
		session_name('wiki6');
		session_start();
	}
	public function ChkSession($pass = null){
		switch(true){
		case is_null($pass): //already
			return isset($_SESSION["wiki6"])?true:false;
			break;
		case hash('sha512',$pass)==$this->conf->password: //success
			$_SESSION["wiki6"] = true;
			break;
		default: //fail
			session_destroy();
			break;
		}
	}
	public function EndSession(){
		$_SESSION = array();
		session_destroy();
	}
}
