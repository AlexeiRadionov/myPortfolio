<?php
session_start();
//подключаем базовый класс моделей
include '../model/Gallery.class.php';
//подключаем автозагрузчик классов
spl_autoload_register(function($className) {
	if (file_exists("../model/$className.class.php")) {
		include "../model/$className.class.php";
	} else if (file_exists("../Twig/$className.class.php")) {
		include "../Twig/$className.class.php";
	}
});
//подключаем контроллеры
include '../controller/ControllerMain.class.php';
include '../controller/ControllerAddFeedback.class.php';

//получаем url страницы
$url_array = explode("/", $_SERVER['REQUEST_URI']);

if ($url_array[1] == "")
	$page_name = "index";
else
	$page_name = $url_array[1];

$action = '';
if ($url_array[2] != "") {
	$action = $url_array[2];
}

//Запускаем главный контроллер
$objControllerMain = new ControllerMain($page_name, $action);
$objControllerMain -> prepareVariables();