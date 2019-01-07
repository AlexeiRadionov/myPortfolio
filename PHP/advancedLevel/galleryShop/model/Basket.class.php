<?php
	class Basket extends Image {
		private $action;

		public function getAction() {
			return $this -> action;
		}

		function __construct($id, $id_session, $action) {
			parent::__construct($id, $id_session);
			$this -> action = $action;
		}

		public function getSumProduct() {
		    $sum = '';
		    $basket = $this -> getBasket();
		    if (is_array($basket)) {
		        foreach ($basket as $value) {
		            $sum += (int)$value['quantity'] * (float)$value['price'];
		        }
		    }
		    return sprintf("%.2f", $sum);
		}

		public function doActionWithBasket(){
		    $response = [
		        "result" => 0,
		        "countProduct" => 0,
		        "sum" => 0,
		        "quantity" => 0
		    ];

		    switch($this -> action){
		        case "add":
		            $id = (int)$_POST['id_good'];
		            $this -> addProduct($id, $this -> getId_session(), $response);
		            break;
		        case "remove":
		            $id = (int)$_POST['id_basket'];
		            $this -> removeProduct($id, $this -> getId_session(), $response);
		            break;
		    }
		    
		    return json_encode($response);
		}

		public function addProduct($id, $id_session, &$response) {
		    $sql = "SELECT * FROM `basket` WHERE id_session = '$id_session' AND id_product = " . $id;
		    $result = $this -> getAssocResult($sql);

		    if (empty($result)) {
		        $sql = "INSERT INTO `basket`(`id_session`, `id_product`, `quantity`) VALUES ('$id_session', '$id', 1)";
		    } else {
		        $sql = "UPDATE `basket` SET `quantity` = `quantity` + 1 WHERE id_session = '$id_session' AND id_product = " . $id;
		    }
		    
		    if($this -> executeQuery($sql)) {
		        $response['result'] = 1;
		        $response['countProduct'] = $this -> getCountProduct();
		    }
		}

		function removeProduct($id, $id_session, &$response) {
		    $sql = "SELECT `id_basket`, `id_product`, `quantity` FROM `basket` WHERE id_session = '$id_session' AND id_product = " . $id;
		    $result = $this -> getAssocResult($sql);

		    if ($result[0]['quantity'] > 1) {
		        $sql = "UPDATE `basket` SET `quantity` = `quantity` - 1 WHERE id_basket = " . $result[0]['id_basket'];
		    } else {
		        $sql = "DELETE FROM `basket` WHERE id_basket = " . $result[0]['id_basket'];
		    }
		    
		    if($this -> executeQuery($sql)) {
		        $response['result'] = 1;
		        $response['countProduct'] = $this -> getCountProduct();
		        $response['sum'] = $this -> getSumProduct();
		        $response['id_product'] = $id;
		        $response['quantity'] = $result[0]['quantity'] - 1;
		    }
		}

		public function template() {
			include '../Twig/Autoloader.php';
			Twig_Autoloader::register();

			try {
				$loader = new Twig_Loader_Filesystem('../templates');
				  
				$twig = new Twig_Environment($loader);
				  
				$template = $twig->loadTemplate('basket.tmpl');

				echo $template->render(array(
				  	'basket' => $this -> getBasket(),
				  	'countProduct' => $this -> getCountProduct(),
				  	'sum' => $this -> getSumProduct(),
				  	'auth' => Auth::$auth,
				  	'back_url' => $_SERVER['REQUEST_URI'],
				  	'user' => Auth::$auth
				));
			  
			} catch (Exception $e) {
			  die ('ERROR: ' . $e->getMessage());
			}
		}
	}
?>