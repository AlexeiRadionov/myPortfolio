<?php
	class ControllerAddFeedback {
		private $date;

		public function getDate() {
			return $this -> date;
		}

		public function setter() {
			$this -> date = date('Y.m.d H:i:s');
		}

		function __construct() {
			$this -> setter();
		}

		public function addFeedback() {
			$name = $_GET['userName'];
			$feedback = $_GET['feedback'];
			$objAddFeedback = new AddFeedback($name, $feedback, $this -> date);
			$objAddFeedback -> addFeedback();
		}
	}
?>