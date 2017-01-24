$=jQuery;
$(document).ready(function(){

    //Slider filters

	var slider = document.getElementById('slider');
    var yearsFrom = $(".yearsFrom").text(),
        yearsTo = $(".yearsTo").text();

	noUiSlider.create(slider, {
		start: [parseInt(yearsFrom), parseInt(yearsTo)],
		step: 1,
		range: {
			'min': parseInt(yearsFrom),
			'max': parseInt(yearsTo)
		},
        format: wNumb({
            decimals: 0
        })
	});

    var yearFrom = $(".yearsFrom");
    var yearTo = $(".yearsTo");

    slider.noUiSlider.on('update', function( values, handle ) {

        var value = values[handle];
        console.log(value);

        if ( handle ) {
            yearTo.val(value);
        } else {
            yearFrom.val(value);
        }
    });


	var slider2 = document.getElementById('slider2');


    var  priceTo = $(".priceHiddenTo").text();

	noUiSlider.create(slider2, {
		start: [0,parseInt(priceTo)],
		step:500,
		range: {
			'min': 0,
			'max': parseInt(priceTo)
		},
        format: wNumb({
            decimals: 0
        })

	});

    var priceFrom = $(".priceFrom");
    var priceTo = $(".priceTo");

    slider2.noUiSlider.on('update', function( values, handle ) {

        var value = values[handle];
        console.log(value);

        if ( handle ) {
            priceTo.val(value);
        } else {
            priceFrom.val(value);
        }
    });

    //slider2.Link('lower').to( $('.priceFrom') );
    //slider2.Link('upper').to( $('.priceTo') );

    //priceFrom.addEventListener('focusout', function(){
    //    slider2.noUiSlider.set([this.value, null]);
    //});
    //
    //priceTo.addEventListener('focusout', function(){
    //    slider2.noUiSlider.set([null, this.value]);
    //});


    // End slider filters


    $("#sortSelect").change(function(){
        $("#sortFilter").submit();
    });

    function sort_selects(options){
        var arr = options.map(function(_, o) {
            return {
                t: $(o).text(),
                v: o.value
            };
        }).get();
        arr.sort(function(o1, o2) {
            return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0;
        });
        options.each(function(i, o) {
            o.value = arr[i].v;
            $(o).text(arr[i].t);
        });
    }

    function sort_selects_asc(options){
        var arr = options.map(function(_, o) {
            return {
                t: $(o).text(),
                v: o.value
            };
        }).get();
        arr.sort(function(o1, o2) {
            return o1.t < o2.t ? 1 : o1.t > o2.t ? -1 : 0;
        });
        options.each(function(i, o) {
            o.value = arr[i].v;
            $(o).text(arr[i].t);
        });
    }
    // Sort select
    sort_selects($('#marks .markOption'));
    sort_selects($('#models .modelOption'));
    sort_selects($('#fuel .fuelOption'));
    sort_selects($('#caroserie .caroserieOption'));
    sort_selects_asc($('#power .powerOption'));


function get_models(mark_id){

    var url = $(".urlAjaxFilter").text();

    var data = {
        action: 'filter_models',
        mark_id: mark_id,

    };
    $.post(url,data, function(response) {
        console.log(response);
        $("#models .modelOption").remove();
        $("#models").append(response);

    });
}

    $("#marks").change(function(){
        get_models($(this).val());

    });

});