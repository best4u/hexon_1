$=jQuery;
$(document).ready(function(){
	var slider = document.getElementById('slider');

	noUiSlider.create(slider, {
		start: [2, 97],
		connect: true,
		range: {
			'min': 0,
			'max': 100
		}
	});

	var slider2 = document.getElementById('slider2');

	noUiSlider.create(slider2, {
		start: [2, 97],
		connect: true,
		range: {
			'min': 0,
			'max': 100
		}
	});
});