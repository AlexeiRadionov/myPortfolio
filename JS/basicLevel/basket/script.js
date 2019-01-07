var buy = document.getElementsByClassName('link');
var basket = document.getElementById('basket');
var sum = 0;  // Стоимость покупок
var score = 0; // Количество товаров в корзине

for (var i = 0; i < buy.length; i++) {
	buy[i].onclick = addBasket;
}

document.getElementById('sum').innerHTML = 'В вашей корзине нет покупок';

function addBasket(event) {
	document.getElementById('sum').innerHTML = '';
	var link = event.target.id.split('_');
	var name = document.getElementById('name_' + link[1]);
	var price = document.getElementById('price_' + link[1]);
	sum = sum + Number(price.innerText);
	name = "<p>" + name.innerHTML + "</p>";
	price = "<p>" + price.innerHTML + " рублей" + "</p>";
	basket.innerHTML += name + price;
	score++;
	
	document.getElementById('sum').innerHTML = "<p class='check'>" + 
	"Всего товаров " + score + 
	". Сумма заказа: " + sum + " рублей" + "</p>";
}







