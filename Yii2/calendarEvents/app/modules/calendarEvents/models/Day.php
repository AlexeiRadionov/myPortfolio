<?php
	namespace app\modules\calendarEvents\models;
	
	use yii\base\Model;

	class Day extends Model {
		public $currentDate;
		public $currentDay;

		public function isWork() {
			$w = date_create($this -> currentDate) -> format('w');
			
			return !in_array($w, [0, 6]);
		}

		public function isWeekend() {
			return !$this -> isWork();
		}

		public function getCurrentDay($currentDate) {
			$this -> currentDate = $currentDate;
			if ($this -> isWeekend()) {
				$this -> currentDay = 'weekend';
			} else {
				$this -> currentDay = 'work day';
			}
		}
	}
?>