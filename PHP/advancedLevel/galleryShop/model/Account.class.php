<?php
	class Account extends Gallery {
		private $back;
		private $user;

		public function getBack() {
			return $this -> back;
		}

		public function getUser() {
			return $this -> user;
		}

		public function setter($back, $user) {
			$this -> back = $back;
			$this -> user = $user;
		}

		function __construct($back, $user) {
			$this -> setter($back, $user);
		}

		public function getInfoGoods() {
			$user = $this -> user;
			$sql = "SELECT `id_user` FROM users WHERE `login` = '$user'";
			$login = $this -> getAssocResult($sql);
			$id_user = $login[0]['id_user'];

		    $sql = "SELECT * FROM `products_in_order`, `images`, `orders` WHERE orders.id_order = products_in_order.id_order AND `id_product` = `id_image` AND `id_user` = '$id_user'";
		    $goods = $this -> getAssocResult($sql);
		    if (empty($goods)) {
		        $goods = 'Пока у вас нет ни одного заказа';
		    }
		    
		    return $goods;
		}

		public function getInfoOrders() {
			$user = $this -> user;
			$sql = "SELECT `id_user` FROM users WHERE `login` = '$user'";
			$login = $this -> getAssocResult($sql);
			$id_user = $login[0]['id_user'];

			$sql = "SELECT `id_order`, `status`, `count`, `amount` FROM `orders` WHERE `id_user` = '$id_user' ORDER BY `id_order` DESC";
			$infoOrders = $this -> getAssocResult($sql);

			return $infoOrders;
		}

		public function template() {
			include '../Twig/Autoloader.php';
			Twig_Autoloader::register();

			try {
			  $loader = new Twig_Loader_Filesystem('../templates');
			  
			  $twig = new Twig_Environment($loader);
			  
			  $template = $twig->loadTemplate('account.tmpl');

			  echo $template->render(array(
			  	'back_url' => $_SERVER['REQUEST_URI'],
			  	'back' => $this -> back,
			  	'auth' => Auth::$auth,
			  	'user' => Auth::$auth,
			  	'goods' => $this -> getInfoGoods(),
			  	'infoOrders' => $this -> getInfoOrders()
			  ));
			  
			} catch (Exception $e) {
			  die ('ERROR: ' . $e->getMessage());
			}	
		}
	}
?>