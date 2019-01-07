var Reviews = function(){
	this.comments = [];
	this.newComment = {};
	this.idNewComment = '';
	this.viewReviews = $('.reviews');
	this.viewNewComment = $('.review');
	this.setEvents();
	this.request(Reviews.urls.list);
};

Reviews.urls = {
	list: 'list.json',
	add: 'add.json',
	remove: 'delete.json',
	submit: 'submit.json'
};

Reviews.prototype.setEvents = function(){
	$('.btn-listReviews').on('click', this.listReviews.bind(this));
	$('.btn-hideReviews').on('click', this.hideReviews.bind(this));
	$('.btn-addReview').on('click', this.onAddReview.bind(this));
	$('.btn-clear').on('click', this.clear.bind(this));
};

Reviews.prototype.setEventsComments = function(){
	$('.btn-submit').on('click', this.submit.bind(this));
	$('.btn-remove').on('click', this.onRemove.bind(this));
};

Reviews.prototype.onRemove = function (event) {
	var id = parseInt($(event.currentTarget).attr('data-id'));
	this.request(Reviews.urls.remove);
	this.removeReview(id);
};

Reviews.prototype.removeReview = function (id) {
	var comment = this.getComment(id);
	if (comment) {
		this.comments.splice(this.comments.indexOf(comment), 1);
	}
	localStorage.setItem("saveComments", JSON.stringify(this.comments));
};

Reviews.prototype.submit = function (event) {
	var id = parseInt($(event.currentTarget).attr('data-id'));
	this.request(Reviews.urls.submit);
	this.addSubmit(id);
};

Reviews.prototype.addSubmit = function (id) {
	var comment = this.getComment(id);
	if (comment) {
		comment.submit++;
	}
	localStorage.setItem("saveComments", JSON.stringify(this.comments));
};

Reviews.prototype.clear = function () {
	localStorage.clear();
	this.request(Reviews.urls.list);
};

Reviews.prototype.listReviews = function () {
	this.viewReviews.show();
};

Reviews.prototype.hideReviews = function () {
	this.viewReviews.hide();
};

Reviews.prototype.getComment = function (id) {
	return this.comments.find(function(comment){
		return comment.id_comment == id;
	});
};

Reviews.prototype.onAddReview = function () {
	if (this.viewNewComment.val() != '') {
		this.idNewComment = this.comments.length + 1;
		this.newComment.id_comment = this.idNewComment;
		this.newComment.text = this.viewNewComment.val();
		this.newComment.submit = 0;
		this.comments.push(this.newComment);
		localStorage.setItem("saveComments", JSON.stringify(this.comments));
		this.request(Reviews.urls.add);
	}
};

Reviews.prototype.addReview = function (response) {
	if (this.getComment(this.idNewComment)) {
		alert(response);
		this.newComment = {};
	}
};

// написать метод render, который выводит html
Reviews.prototype.render = function(){
	for (var i = 0; i < this.comments.length; i++) {
		var comment = '<div><p>' + this.comments[i].text + '</p><p>Одобрено: ' + this.comments[i].submit + '</p></div>';
		this.viewReviews.append(comment);
		this.viewReviews.append('<button data-id="' + this.comments[i].id_comment + '" class="btn-submit">Одобрить отзыв</button>');
		this.viewReviews.append('<button data-id="' + this.comments[i].id_comment + '" class="btn-remove">Удалить отзыв</button><hr>');
	}
	this.setEventsComments();
};

// реализовать метод запроса на сервер
Reviews.prototype.request = function(url, data){
	$.post({
		url: url,
		data: data,
		dataType: 'json',
		context: this,
		success: function(response){
			this.process(url, response);
		},
		error: function(error){
			alert('error');
		}
	});
};

// метод обработки запроса
Reviews.prototype.process = function(url, response){
	if ( response.result ) {
		switch ( url ) {
			case Reviews.urls.list:
				if (localStorage.getItem("saveComments") !== null) {
					this.comments = JSON.parse(localStorage.getItem("saveComments"));
				} else {
					this.comments = response.comments;
				}
				break;
			case Reviews.urls.add:
				this.addReview(response.userMessage);
				$('.review').val('');
				break;
			default:
				break;
		}
		this.viewReviews.html('');
		this.render();
	}
};

$(document).ready(function(){
	var reviews = new Reviews();
});