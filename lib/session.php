<?php
	/**
	 * SESSION Class
	 */
	class Session{
	   public static function init(){
	   	session_start();
	   }
// here we use set function in SeSSION CLASS....here we use [$key] instead of ['$key']..because without quation means we can use & store many [VALUES]...
	   public static function set($key,$val){
	   		$_SESSION[$key]=$val;

	   }

	   public static function get($key){
// here we check our $KEY is already set or not
	   		if (isset($_SESSION[$key])) {
	   			return $_SESSION[$key];
	   		}else {
	   			return false;
	   		}
	   }

// check our profile is login or logout

		public static function checkSession(){
			self::init();
			if (self::get("login")==false) {
				self::destroy();
				header("Location:login.php");
			}
		}	 

//checkLogin use to login/logout option.like if you login one page then login.php redirect to index.php
		public static function checkLogin(){
			self::init();
			if (self::get("login")==true) {
				header("Location:index.php");
			}
		}  

		public static function destroy(){
			session_destroy();
			header("Location:login.php");
		}
	}
?>