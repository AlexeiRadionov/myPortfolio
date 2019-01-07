var result, text;
var check, message;
var pattern = [
	/^[a-z]+$/i,
	/^\d\d\.\d\d\.\d\d\d\d$/,
	/^\+[7]\(\d{3}\)\d{3}-\d{4}$/,
	/^[a-z]+[.-]*[a-z]+\@[a-z]+[.][a-z]{2,}$/i,
	/^[a-z]+$/i,
	/.+/
]
var input = $('.form');

function sendForm() {
	for (var i = 0; i < input.length; i++) {
		check = false;
		checkForm(pattern[i], input[i]);
		if (check) {
			message = 'error';
			userMessage(message);
			return;
		}
	}
	message = 'success';
	userMessage(message);
}

function checkForm (pattern, input) {
	text = input.value;
	result = pattern.test(text);

	if (!result) {
		input.style = "border: 5px solid red";
		var id = input.getAttribute('id');
		$('#' + id).effect('bounce');
		check = true;
	} else {
		input.style = "";
	}
}

function userMessage(message) {
	$('#message').text(message);
	$('#message').dialog({
		modal: true,
		buttons: {
			OK: function () {
				if (message == 'error') {
					$(this).dialog('close');
				} else if (message == 'success') {
					$(this).dialog('close');
					$('#button').click();
				}
			}
		}
	});
}

$(document).ready(function () {
	$.get({
		url: 'city.json',
		dataType: 'json',
		success: function (data) {
			$('#city').autocomplete({
			source: data,
			minLength: 0,
			});

			$('#city').on('focus', function() { 
				if ($(this).val() == '')
					$(this).autocomplete('search', '');
			});
		}
	})
});

$(document).ready(function () {
	$('#date').datepicker({
		monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
		dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
		dateFormat: 'dd.mm.yy'
	});
});