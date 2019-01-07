<?php
	class Auth extends Gallery {
		public static $auth;

		public function setAuth($user = '') {
			self::$auth = $user;
		}

		public function alreadyLogin() {
			$login = $_SESSION['login'];
			$pass = $_SESSION['pass'];
			$sql = "SELECT `login`, `password` FROM `users` WHERE `login` = '$login' AND `password` = '$pass'";
			$result = $this -> getAssocResult($sql);
			if ($result) {
				return true;
			} else {
				return false;
			} 
		}

		public function getAuth($login, $pass) {
			$login = strip_tags($login);
			$pass = strip_tags($pass);
			$_SESSION["login"] = $login;
			$_SESSION["pass"] = $pass; 
		}

		public function isAdmin($login, $pass) {
			return ($login == 'admin' && $pass == '123');
			
		}

		public function template() {
			
		}
	}
?>