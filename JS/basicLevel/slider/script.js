var img = [
	"<img src='images/ball.png'>",
	"<img src='images/bear.png'>",
	"<img src='images/cubes.png'>",
	"<img src='images/dog.png'>",
	"<img src='images/elephant.png'>",
	"<img src='images/hare.png'>"
];
var back = document.getElementById('back');
var forward = document.getElementById('forward');
var slider = document.getElementById('slider');
var i = 0;

slider.innerHTML = img[0];
forward.onclick = f;
back.onclick = b;

function f() {
	if (i == (img.length - 1)) {
		i = -1;
	}
	i++;
	slider.innerHTML = '';
	slider.innerHTML = img[i];
}

function b() {
	if (i == 0) {
		i = img.length;
	}
	i--;
	slider.innerHTML = '';
	slider.innerHTML = img[i];
}


	










