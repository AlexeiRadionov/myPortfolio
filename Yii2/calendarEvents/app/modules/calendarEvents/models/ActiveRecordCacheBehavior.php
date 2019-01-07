<?php
	namespace app\modules\calendarEvents\models;

	use Yii;
	use yii\base\Behavior;
	use yii\db\ActiveRecord;

	class ActiveRecordCacheBehavior extends Behavior {
	
		public $cacheKeyName;
		
		public function events() {

			return [
				ActiveRecord::EVENT_AFTER_INSERT => 'deleteCache',
				ActiveRecord::EVENT_AFTER_UPDATE => 'deleteCache',
				ActiveRecord::EVENT_AFTER_DELETE => 'deleteCache',
				];
		}
		
		public function deleteCache() {
			Yii::$app->cache->delete($this->owner->getPrimaryKey() . "_" . $this->cacheKeyName);
		}
	}
?>