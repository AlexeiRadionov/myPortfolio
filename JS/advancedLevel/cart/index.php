<?php
	require_once('php/config.php');
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	<script src="js/cart.js" type="text/javascript"></script>
	<style>
		#cart {
			width: 200px;
			border: 1px solid #000;
		}
		.hover {
			color: red;
		}
	</style>
</head>
<body>
	<div id="cart">
		<div>Товаров: <span class="items"></span></div>
		<div>Сумма: <span class="amount"></span></div>
		<a href="#" class="btn-clear">Очистить</a>
	</div>

	<div id="products">
		<?php foreach ( $products as $id => $product ) { ?>
		<div class="product product-<?php echo $id ?>">
			<p data-id="<?php echo $id ?>" class="name"><b><?php echo $product['name'] ?></b></p>
			<p>Цена : <span class="price"><?php echo $product['price'] ?></span>
			&bull; В корзине : <span class="count">0</span></p>
			<div>
				<a href="#" class="btn-add" data-id="<?php echo $id ?>">Купить</a> | 
				<a href="#" class="btn-remove" data-id="<?php echo $id ?>">Удалить</a>
			</div>
		</div>
		<?php } ?>

	</div>
</body>
</html>