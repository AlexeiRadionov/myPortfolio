var Cart = function(){
	this.items = [];
	this.view = {};
	this.view.cart = $('#cart');
	this.view.products = $('#products');
	this.totalAmount = 0;
	this.itemsCount = 0;
	this.setEvents();
	//this.request(Cart.urls.load);
};

Cart.urls = {
	load: 'app/php/cart.php/?method=get',
	add: 'app/php/cart.php/?method=add',
	remove: 'app/php/cart.php/?method=remove',
	clear: 'app/php/cart.php/?method=clear'
};

Cart.prototype.setEvents = function(){
	$('.btn-clear').on('click', this.clearCart.bind(this));
	$('.btn-remove').on('click', this.onRemove.bind(this));
	$('.btn-add').on('click', this.onAdd.bind(this));
};

Cart.prototype.setEventsMouse = function(){
	$(document).ready(function(){
		$('p.name').draggable({
			cursor: 'move',
			helper: 'clone'
		});

		$('#cart').droppable({
			accept: 'p.name',
			over: function (event, ui) {
				ui.draggable.addClass('hover');
			},
			drop: function (event, ui) {
				ui.draggable.removeClass('hover');
				
				var id = ui.draggable.attr('data-id');
				$('.btn-add[data-id="'+id+'"]').click();
			}
		})
	});
};

Cart.prototype.onRemove = function(event){
	if (!id) {
		var id = parseInt($(event.currentTarget).attr('data-id'));
	}

	if ( id && this.getProduct(id) ) {
		this.request(Cart.urls.remove, 'id=' + id);
	}
};

Cart.prototype.clearCart = function(cb){
	if (this.itemsCount) {
		this.request(Cart.urls.clear, '', cb);
	}
};

Cart.prototype.onAdd = function(event, id, cb){
	if (!id) {
		var id = parseInt($(event.currentTarget).attr('data-id'));
	}

	if ( id ) {
		this.request(Cart.urls.add, 'id=' + id, cb);
	}
};

// написать метод render, который выводит html
Cart.prototype.render = function(){
	this.view.cart.find('.items').html(this.itemsCount);
	this.view.cart.find('.amount').html(this.totalAmount);
	this.view.products.find('.count').html('0');

	this.items.forEach(function(item){
		this.view.products.find('.product-' + item.id).find('.count').html(item.count);
	}, this);
};

// реализовать метод запроса на сервер
Cart.prototype.request = function(url, data, cb){
	$.get({
		url: url,
		data: data,
		dataType: 'json',
		context: this,
		success: function(response){
			this.process(url, response);
			if ( cb ) {
				cb();
			}
		},
		error: function(error){
			console.log('error');
		}
	});
};

Cart.prototype.getProduct = function(id){
	return this.items.find(function(item){
		return item.id == id;
	});
};

Cart.prototype.removeProduct = function(id){
	var item = this.getProduct(id);
	if (item) {
		--item.count;
		if ( item.count == 0) {
			this.items.splice(this.items.indexOf(item), 1);
		}
	}
};

Cart.prototype.addProduct = function(product){
	var item = this.getProduct(product.id);

	if ( item ) {
		++item.count;
	} else {
		this.items.push(product);
	}
};

Cart.prototype.calculate = function(){
	this.totalAmount = 0;
	this.itemsCount = 0;

	this.items.forEach(function(item){
		if ( item.count > 0 ) {
			this.itemsCount += item.count;
			this.totalAmount += (item.count * item.price);
		}
	}, this);
};

// метод обработки запроса
Cart.prototype.process = function(url, response){
	if ( response.result ) {
		switch ( url ) {
			case Cart.urls.load:
				this.items = response.items;
				break;
			case Cart.urls.add:
				this.addProduct(response.item);
				break;
			case Cart.urls.remove:
				this.removeProduct(response.id);
				break;
			case Cart.urls.clear:
				this.items = [];
				break;
			default:
				break;
		}
		this.calculate();
		this.render();
	}
};

/*$(document).ready(function(){
	var cart = new Cart();
});*/