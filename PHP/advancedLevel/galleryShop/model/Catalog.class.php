<?php
	class Catalog extends Gallery {
		private $action;

		public function getAction() {
			return $this -> action;
		}

		public function setter($action) {
			$this -> action = $action;
		}

		function __construct($action) {
			$this -> setter($action);
		}

		public function showGoods($countGoods = 5) {
		    $sql = "SELECT `id_image`, `path_img`, `description`, `price` FROM `images` LIMIT $countGoods";
		    $catalog = $this -> getAssocResult($sql);
		    
		    return $catalog;
		}

		public function addShowGoods(){
		    $response = [
		        "result" => 0
		    ];

		    if ($this -> action == 'addShowGoods') {
		        $countGoods = (int)$_POST['countGoods'];
		        $result = $this -> showGoods($countGoods);
		        $sql = "SELECT COUNT(*) FROM `images`";
		        $count = $this -> getAssocResult($sql);
		        if ($countGoods >= $count[0]['COUNT(*)']) {
		            $response['answer'] = 1;
		        }
		        $response['result'] = 1;
		        foreach ($result as $key => $value) {
		            $response["$key"] = $value;
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
			  
			  $template = $twig->loadTemplate('catalog.tmpl');

			  echo $template->render(array(
			  	'catalog' => $this -> showGoods(),
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