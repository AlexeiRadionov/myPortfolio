var button1 = document.getElementById('but_0');
var button2 = document.getElementById('but_1');
var blockImage = document.getElementById('block');
var arrImg = ['images/1.png'];
var url = '/result.json';
var xhr = false;
var result;

button1.onclick = loadImage;
button2.onclick = loadImage;

function loadImage(event) {
	blockImage.innerHTML = "";
	var img = document.createElement('img');
	var numberImg = event.target.id.split('_');
	img.src = arrImg[numberImg[1]];
	img.className = 'img';
	blockImage.appendChild(img);

	if (arrImg.indexOf(arrImg[numberImg[1]]) != -1) {
		blockImage.innerHTML += "<p> File load " + result.response2 + "</p>";
	}
	
	img.onerror = function() {
		blockImage.innerHTML = "";
		blockImage.innerHTML += "<p> File load " + result.response1 + "</p>";
	}
}

window.onload = function () {
	if ( window.XMLHttpRequest ) {
		xhr = new XMLHttpRequest();
	} else if ( window.ActiveXObject ) {
		try {
			xhr = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xhr = new ActiveXObject('Microsoft.XMLHTTP');
			} catch (e) {}
		}
	}

	if ( !xhr ) {
		alert('Could not create XHR');
	}

	xhr.onreadystatechange = load;
	xhr.open('GET', url, true);
	xhr.send(null);
}

function load() {
	if ( xhr.readyState == 4 ) {
		if ( xhr.status == 200 ) {
			result = JSON.parse(xhr.responseText);
			console.log(result);
		}
	}
}