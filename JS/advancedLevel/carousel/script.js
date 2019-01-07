var Images = function(){
	this.items = [];
	this.images = [];
	this.viewImages = $('#carousel');
	this.request();
};

Images.prototype.render = function(data){
	this.items = data;
	for (var i = 0; i < this.items.length; i++) {
		var image = '<li><img id="'+ this.items[i].id +'" src="'+this.items[i].src+'"></li>';
		this.images.push(image);
		this.viewImages.append(image);
	}

	console.log(this.images);
	console.log(this);
	setTimeout(this.animation.bind(this), 100);
};

Images.prototype.animation = function () {
	$(function()    {
	    $("#block-images").jCarouselLite({
			auto: 2000,
			speed: 1000,
			circular: true,
			visible: 1
	    });
	});
}

Images.prototype.request = function(){
	$.get({
		url: 'images.json',
		dataType: 'json',
		context: this,
		success: function (data) {
			this.render(data);
		}
	});
}

$(document).ready(function(){
	var images = new Images();
});