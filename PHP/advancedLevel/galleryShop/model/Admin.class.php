<?php
	class Admin extends Gallery {
		private $id;
		private $action;

		public function getId() {
			return $this -> id;
		}

		public function getAction() {
			return $this -> action;
		}

		public function setter($id, $action) {
			$this -> id = $id;
			$this -> action = $action;
		}

		function __construct($id = '', $action = '') {
			$this -> setter($id, $action);
		}

		public function getOrders() {
			$sql = "SELECT * FROM `orders`, `users` WHERE orders.id_user = users.id_user ORDER BY orders.id_user,`status`";
			$orders = $this -> getAssocResult($sql);

			return $orders;
		}

		public function getGoods() {
			$sql = "SELECT * FROM `images`";
			$goods = $this -> getAssocResult($sql);

			return $goods;
		}

		public function getOrderInfo() {
			$id_order = $this -> id;
			$sql = "SELECT * FROM `products_in_order`, `images`, `orders`, `users` WHERE orders.id_order = '$id_order' AND products_in_order.id_order = '$id_order' AND `id_product` = `id_image` AND orders.id_user = users.id_user";
			$orderInfo = $this -> getAssocResult($sql);

			return $orderInfo;
		}

		public function getGoodInfo() {
			$id_good = $this -> id;
			$sql = "SELECT * FROM `images` WHERE `id_image` = '$id_good'";
			$goodInfo = $this -> getAssocResult($sql);

			return $goodInfo[0];
		}

		public function addGood() {
			$response = [
				'result' => 0
			];
			
			$path_img = $_POST['path_img'];
			$description = $_POST['description'];
			$count_preview = $_POST['count_preview'];
			$price = $_POST['price'];

			if ($path_img != '' && $description != '' && $count_preview != '' && $price != '') {
				$sql = "INSERT INTO `images`(`path_img`, `description`, `count_preview`, `price`) VALUES ('$path_img', '$description', '$count_preview', '$price')";

				if ($this -> executeQuery($sql)) {
					$lastInsert = $this -> lastInsertId();
					$sql = "SELECT * FROM `images` WHERE `id_image` = '$lastInsert'";
					$result = $this -> getAssocResult($sql);

					foreach ($result[0] as $key => $value) {
						$response["$key"] = $value;
					}
					
					$response['result'] = 1;
				}
			}
			
			return json_encode($response);
		}

		public function editGood() {
			$response = [
				'result' => 0
			];
			
			$description = $_POST['description'];
			$price = $_POST['price'];
			$id_good = $_POST['id_good'];

			if ($description != '' && $price != '') {
				$sql = "UPDATE `images` SET `description` = '$description', `price` = '$price' WHERE `id_image` = '$id_good'";

				if ($this -> executeQuery($sql)) {
					$sql = "SELECT `description`, `price` FROM `images` WHERE `id_image` = '$id_good'";
					$result = $this -> getAssocResult($sql);

					foreach ($result[0] as $key => $value) {
						$response["$key"] = $value;
					}
					
					$response['result'] = 1;
				}
			}
			
			return json_encode($response);
		}

		public function changeStatus() {
			$response = [
				'result' => 0
			];
			
			$status = $_POST['status'];
			foreach ($_POST as $key => $value) {
				if ($key == 'orders') {
					foreach ($value as $val) {
						$id_order = (int)$val;
						$sql = "UPDATE `orders` SET `status` = '$status' WHERE id_order = $id_order";
						
						if ($this -> executeQuery($sql)) {
							$sql = "SELECT `id_order`, `status` FROM `orders` WHERE id_order = $id_order";
							$result = $this -> getAssocResult($sql);
							$response["$id_order"] = $result[0];
							$response['result'] = 1;
						}
					}
				}
			}

			return json_encode($response);
		}

		public function template() {
			include '../Twig/Autoloader.php';
			Twig_Autoloader::register();

			try {
			  $loader = new Twig_Loader_Filesystem('../templates');
			  
			  $twig = new Twig_Environment($loader);
			  
			  $template = $twig->loadTemplate('admin.tmpl');

			  echo $template->render(array(
			  	'user' => Auth::$auth,
			  	'orders' => $this -> getOrders(),
			  	'goods' => $this -> getGoods(),
			  	'action' => $this -> action,
			  	'id_order' => $this -> id,
			  	'orderInfo' => $this -> getOrderInfo(),
			  	'goodInfo' => $this -> getGoodInfo()
			  ));
			  
			} catch (Exception $e) {
			  die ('ERROR: ' . $e->getMessage());
			}	
		}
	}
?>