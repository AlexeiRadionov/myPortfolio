<?php
	class ControllerMain {
		private $page_name;
		private $action;
		private $date;
		private $id_session;
		private $back;
		private $id;
		private $user;

		public function getPage_name() {
			return $this -> page_name;
		}

		public function getAction() {
			return $this -> action;
		}

		public function getDate() {
			return $this -> date;
		}

		public function getId_session() {
			return $this -> id_session;
		}

		public function getBack() {
			return $this -> back;
		}

		public function getId() {
			return $this -> id;
		}

		public function getUser() {
			return $this -> user;
		}

		public function setter($page_name, $action) {
			$this -> page_name = $page_name;
			$this -> action = $action;
			$this -> date = date('Y.m.d H:i:s');
			$this -> id_session = session_id();
			$this -> back = strip_tags($_GET['back']);
			if (isset($_GET['id'])) {
		        $this -> id = (int)strip_tags($_GET['id']);
		    }
		}

		function __construct($page_name, $action) {
			$this -> setter($page_name, $action);
		}

		public function prepareVariables() {
			$back = $this -> back;
			if (isset($_GET['send'])) {
				$objControllerAddFeedback = new ControllerAddFeedback();
				$objControllerAddFeedback -> addFeedback();
			}
			$objAuth = new Auth();
		    
		    if ($objAuth -> alreadyLogin()) {
		    	$this -> user = $_SESSION['login'];
		    	$objAuth -> setAuth($this -> user);
		    } else {
		    	$objAuth -> setAuth();
		    }

			switch ($this -> page_name) {
		        case 'index':
		            $objImages = new Images();
					$objImages -> template();
		            break;
		        case 'image':
		            $objImage = new Image($this -> id, $this -> id_session);
		            $objImage -> template();
		            break;
		        case 'catalog':
		            if ($this -> action == '') {
		                $objCatalog = new Catalog($this -> action);
						$objCatalog -> template();
		            } else {
		            	$objCatalog = new Catalog($this -> action);
		            	echo $objCatalog -> addShowGoods();
		            }
		            break;
		        case 'login':
		            $login = $_POST['login'];
		            $pass = $_POST['pass'];
		            $objAuth -> getAuth($login, $pass);
		            if ($objAuth -> isAdmin($login, $pass)) {
		    			header("Location: /admin/");
		    		} else {
		    			header("Location: {$back}");
		    		}
		            break;
		        case 'logout':
		            $_SESSION['login'] = null;
		            $_SESSION['pass'] = null;
		            
		            (!empty($back)) ? header("Location: {$back}") : header("Location: /");
		            break;
		        case 'basket':
		            if ($this -> action == '') {
		            	$objBasket = new Basket($this -> id, $this -> id_session, $this -> action);
						$objBasket -> template();
		            } else {
		            	$objBasket = new Basket($this -> id, $this -> id_session, $this -> action);
		            	echo $objBasket -> doActionWithBasket();
		            }
		            break;
		        case 'registration':
		        	$objRegistration = new Registration();
		        	if (isset($_POST['sendForm'])) {
		        		$login = $_POST['login'];
		        		$pass = $_POST['pass'];
		        		$email = $_POST['email'];
		        		if ($objRegistration -> addUser($login, $pass, $email)) {
		        			$objRegistration -> template();
		        		} else {
		        			header("Location: {$back}");
		        		}
		        	} else {
		        		$objRegistration -> template();
		        	}
		        	break;
		        case 'account':
		        	$objAccount = new Account($back, $this -> user);
		        	$objAccount -> template();
		        	break;
		        case 'orders':
		        	if ($this -> user) {
		        		$objAddOrders = new AddOrders($this -> id, $this -> id_session, $this -> action);

		        		if ($objAddOrders -> addOrder($this -> id_session, $this -> user, $this -> date)) {

		        			header("Location: /account/");
		        		}
		        	} else {
		        		header("Location: /basket/");
		        	}
		        	break;
		        case 'admin':
		        	if (!($objAuth -> isAdmin($_SESSION['login'], $_SESSION['pass']))) {
		    			header("Location: /");
		    		}
		        	if ($this -> action == 'changeStatus') {
			        	$objAdmin = new Admin();
		        		echo $objAdmin -> changeStatus();
		        	} else if ($this -> action == 'addGood') {
			        	$objAdmin = new Admin();
		        		echo $objAdmin -> addGood();
		        	} else if ($this -> action == 'edit') {
			        	$objAdmin = new Admin();
		        		echo $objAdmin -> editGood();
			        } else {
		        		$objAdmin = new Admin($this -> id, $this -> action);
			        	$objAdmin -> template();
		        	}
		        	break;
		    }
		}
	}
?>