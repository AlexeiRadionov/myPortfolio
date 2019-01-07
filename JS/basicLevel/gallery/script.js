var imgSmall = document.getElementsByTagName('img');
var imgBig = document.getElementById('big_photo');
var img;

for (var i = 0; i < imgSmall.length; i++) {
	imgSmall[i].onclick = bigPhoto;
}

function bigPhoto(event) {
	imgBig.innerHTML = "";
	img = document.createElement('img');
	var numberImg = event.target.id.split('_');
	img.src = "images/big/" + numberImg[1] + ".png";
	imgBig.appendChild(img);
	img.onerror = function() {
		imgBig.removeChild(img);
		alert("Файл не найден");
	}
}




