<?php
	class BDD{
		private static $connexion;
			public static function get(){
			   if(!self::$connexion instanceof PDO){
			      self::$connexion = new PDO('mysql:host=localhost;dbname=quizz;charset=utf8', 'root', '');
			   }
			   return self::$connexion;
			}
	}
?>