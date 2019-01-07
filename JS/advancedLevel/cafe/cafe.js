// Создаём класс Hamburger
var Hamburger = function () {
	this.size = "";
	this.stuffingCheese = "";
	this.stuffingSalad = "";
	this.stuffingPotato = "";
	this.toppingMayo = "";
	this.toppingSpice = "";
}

// Создаём методы для класса Hamburger

// Добавляем в гамбургер добавку
Hamburger.prototype.addTopping = function() {
	do {
		var topping = prompt("Посыпать приправой? 1 - да, 2 - нет");
	} while(topping != "1" && topping != "2");
	
	if (topping == "1") {
		this.toppingSpice = "Добавка: специи.";
		this.price += 15;
	}

	do {
		topping = prompt("Полить майонезом? 1 - да, 2 - нет");
	} while(topping != "1" && topping != "2");

	if (topping == "1") {
		this.toppingMayo = "Добавка: майонез.";
		this.price += 20;
		this.calories += 5;
	}

	this.getMyHamburger();
}

// Выбираем размер гамбургера
Hamburger.prototype.getSize = function() {
	do {
		var size = prompt("Выберите размер гамбургера: 1 - small, 2 - large");
	} while(size != "1" && size != "2");
	
	if (size == "1") {
		this.size = "Размер: маленький.";
		this.price += 50;
		this.calories += 20;
	} else {
		this.size = "Размер: большой.";
		this.price += 100;
		this.calories += 40;
	}

	this.getStuffing();
}

// Добавляем в гамбургер начинку
Hamburger.prototype.getStuffing = function() {
	do {
		var stuffing = prompt("Выберите начинку: 1 - cheese, 2 - salad, 3 - potato");
	} while(stuffing != "1" && stuffing != "2" && stuffing != "3");
	
	if (stuffing == "1") {
		this.stuffingCheese = "Начинка: сыр.";
		this.price += 10;
		this.calories += 20;
	} else if (stuffing == "2") {
		this.stuffingSalad = "Начинка: салат.";
		this.price += 20;
		this.calories += 5;
	} else {
		this.stuffingPotato = "Начинка: картофель.";
		this.price += 15;
		this.calories += 10;
	}

	this.addTopping();
}

// Выводим готовый гамбургер на экран
Hamburger.prototype.getMyHamburger = function() {
	this.price = String(this.price);
	this.price += " рублей.";
	this.calories = String(this.calories);
	this.calories += " калорий.";

	for (var i in myHamburger) {
		if (myHamburger[i] != "" && typeof(myHamburger[i]) != "function") {
			var order = document.createElement("p");
			order.innerText = myHamburger[i];
			document.body.appendChild(order);
		}
	}
}

// Создаём наследника класса Hamburger - класс MyHamburger
var MyHamburger = function () {
	Hamburger.call(this);
	this.price = 0;
	this.calories = 0;
}

MyHamburger.prototype = Object.create(Hamburger.prototype);
MyHamburger.prototype.constructor = MyHamburger;

// Помещаем экземпляр класса MyHamburger в переменную myHamburger и запускаем выбор гамбургера
var myHamburger = new MyHamburger();
myHamburger.getSize();
console.log(myHamburger);