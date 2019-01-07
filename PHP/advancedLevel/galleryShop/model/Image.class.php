<?php
	class Image extends Gallery {
		private $id;
		private $id_session;

		public function getId() {
			return $this -> id;
		}

		public function getId_session() {
			return $this -> id_session;
		}

		public function setter($id, $id_session) {
			$this -> id = $id;
			$this -> id_session = $id_session;
		}

		function __construct($id, $id_session) {
			$this -> setter($id, $id_session);
		}

		public function getImagesContent(){
		    $sql = "SELECT `id_image`, `path_img`, `description`, `price` FROM `images` WHERE id_image = " . $this -> id;
		    $images = $this -> getAssocResult($sql);

			//В случае если изображения нет, вернем пустое значение
		    $result = [];
		    if(isset($images[0]))
		        $result = $images[0];
		    
		    return $result;
		}

		public function countPreview() {
		    $sql = "UPDATE `images` SET `count_preview` = `count_preview` + 1 WHERE id_image = " . $this -> id;
		    $this -> executeQuery($sql);
		    
		    $sql = "SELECT `count_preview` FROM `images` WHERE id_image = " . $this -> id;
		    $count = $this -> getAssocResult($sql);
		    
		    return $count[0]['count_preview']; 
		}

		public function getBasket(){
			$id_session = $this -> getId_session();
		    $sql = "SELECT * FROM `basket`, `images` WHERE `id_session` = '$id_session' AND `id_product` = `id_image`";
		    $basket = $this -> getAssocResult($sql);
		    if (empty($basket)) {
		        $basket = 'Ваша корзина пуста';
		    }
		    
		    return $basket;
		}

		public function getCountProduct() {
		    $countProduct = '';
		    $basket = $this -> getBasket();
		    if (is_array($basket)) {
		        foreach ($basket as $value) {
		            $countProduct += (int)$value['quantity'];
		        }
		    }
		    return $countProduct;
		}

		public function template() {
			include '../Twig/Autoloader.php';
			Twig_Autoloader::register();

			try {
				$loader = new Twig_Loader_Filesystem('../templates');
				  
				$twig = new Twig_Environment($loader);
				  
				$template = $twig->loadTemplate('image.tmpl');

				echo $template->render(array(
				  	'image' => $this -> getImagesContent(),
				  	'countPreview' => $this -> countPreview(),
				  	'countProduct' => $this -> getCountProduct(),
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