<?php
	class AddFeedback extends Images {
		private $name;
		private $feedback;
		private $date;

		public function getName() {
			return $this -> name;
		}

		public function getFeedback() {
			return $this -> feedback;
		}

		public function getDate() {
			return $this -> date;
		}

		public function setter($name, $feedback, $date) {
			$this -> name = $name;
			$this -> feedback = $feedback;
			$this -> date = $date;
		}

		function __construct($name, $feedback, $date) {
			$this -> setter($name, $feedback, $date);
		}

		public function addFeedback() {
			$name = $this -> name;
			$feedback = $this -> feedback;
			$date = $this -> date;
			$sql = "INSERT INTO `feedback`(`name`, `text_fb`, `date`) VALUES ('$name', '$feedback', '$date')";
	    	$this -> executeQuery($sql);
	    	
	    	header('Location: /');
		}
	}
?>