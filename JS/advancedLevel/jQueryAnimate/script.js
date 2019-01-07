$(document).on('click', '.tab', function () {
	var tab = $(this);
	if (!tab.hasClass('active')) {
		var textId = $('.active').attr('data-id');
		$('.active').removeClass('active');
		tab.addClass('active');
		$(".text[data-id='" + textId + "']").slideToggle(2000, function() {
			$('.opened').removeClass('opened');
			$(".text[data-id='" + tab.attr('data-id') + "']").slideToggle(2000);
		});
	}
})