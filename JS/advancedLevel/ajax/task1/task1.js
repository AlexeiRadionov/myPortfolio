var url = "/content.json";
var items = [];

var Container = function() {
  this.id = 'block';
  this.className = 'block-image';
};

Container.prototype.render = function() {
	return "<div id='" + this.id + "' class='" + this.className + "'></div>";
};

var Menu = function(items) {
   Container.call(this);
   this.items = items;
   this.init();
};

Menu.prototype = Object.create(Container.prototype);
Menu.prototype.constructor = Menu;

Menu.prototype.init = function(){
	this.xhr = false;

	if ( window.XMLHttpRequest ) {
		this.xhr = new XMLHttpRequest();
	} else if ( window.ActiveXObject ) {
		try {
			this.xhr = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				this.xhr = new ActiveXObject('Microsoft.XMLHTTP');
			} catch (e) {}
		}
	}

	if ( !this.xhr ) {
		alert('Could not create XHR');
	}

	this.xhr.onreadystatechange = this.onPageLoad.bind(this);
};

Menu.prototype.load = function(url){
	this.xhr.open('GET', url, true);
	this.xhr.send();
};

Menu.prototype.onPageLoad = function(){
	if ( this.xhr.readyState == 4 ) {
		if ( this.xhr.status == 200 ) {
			var data = JSON.parse(this.xhr.responseText);
			this.render(data);
		} else {
			console.log('123');
		}
	}
}

Menu.prototype.render = function(data){
	for (var j in data) {
		this.items.push(data[j]);
	}
	
	var result = '';
	
	for (var i = 0; i < this.items.length; i++) {
		result += '<a href="' + this.items[i].big + '" target="_blank">';
		result += '<img class="img" src="' + this.items[i].small + '">' + '</a>';
	}
	
	document.getElementById(this.id).innerHTML = result;
};

var container = new Container();
document.write(container.render());

var menu = new Menu(items);
menu.load(url);