<?php
	namespace app\modules\calendarEvents\assets;

	use yii\web\AssetBundle;

	class EventsAsset extends AssetBundle {
		
		public $basePath = '@app/modules/calendarEvents/assets';
	    public $baseUrl = '@web';
	    public $css = [
	    	'css/site.css',
	        'css/events_style.css',
	    ];
	    public $js = [

	    ];
	    public $depends = [
	        'yii\web\YiiAsset',
	        'yii\bootstrap\BootstrapAsset',
	    ];
	}
?>