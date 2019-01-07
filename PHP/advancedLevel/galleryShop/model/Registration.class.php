<?php
	class Registration extends Gallery {
		private $error = 0;

		public function addUser($login, $pass, $email) {
			$sql = "SELECT `login` FROM users WHERE `login` = '$login'";
			$result = $this -> getAssocResult($sql);
			if (!empty($result)) {
				$this -> error = 1;
				return true;
			} else {
				$sql = "INSERT INTO `users`(`login`, `password`, `email`) VALUES ('$login', '$pass', '$email')";
				$this -> executeQuery($sql);
				return false;
			}
		}

		public function template() {
			include '../Twig/Autoloader.php';
			Twig_Autoloader::register();

			try {
			  $loader = new Twig_Loader_Filesystem('../templates');
			  
			  $twig = new Twig_Environment($loader);
			  
			  $template = $twig->loadTemplate('registration.tmpl');

			  echo $template->render(array(
			  	'error' => $this -> error
			  ));
			  
			} catch (Exception $e) {
			  die ('ERROR: ' . $e->getMessage());
			}	
		}
	}
?>