$=jQuery;
$(document).ready(function(){


    $(".allCarsButton").click(function(e){
        e.preventDefault();
        $("#sortFilter").submit();
    });


    //Slider filters

    var $sidebarFilters = $('.sidebarFilters');

    if( $sidebarFilters.length ) {


    var slider2 = document.getElementById('slider2');

    if(slider2) {

        var priceTo = $(".priceHiddenTo").text();
        var priceFromMin = $(".priceFromMin").text();
        var priceFromMax = $(".priceFromMax").text();
        if (priceFromMin == "") {
            priceFromMin = 0;
        }

        noUiSlider.create(slider2, {
            start: [parseInt(priceFromMin), parseInt(priceFromMax)],
            step: 500,
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

        var priceFromField = $(".priceFromField");

        slider2.noUiSlider.on('update', function (values, handle) {

            var value = values[handle];

            var Format = wNumb({
                prefix: '€ ',
                decimals: 0,
                thousand: '.'
            });


            if (handle) {
                priceTo.val(value);

                $(".priceTo").text(Format.to(parseInt(value)));
            } else {
                if(parseInt(value) != 0){
                    priceFrom.val(value);
                }
                
                $(".priceFrom").text(Format.to(parseInt(value)));
            }
        });
    }



        var slider3 = document.getElementById('slider3');

        var yearsFrom = $(".yearsFrom").text(),
        yearsTo = $(".yearsTo").text(),
        yearFromMin = $(".yearFromMin").text(),
        yearFromMax = $(".yearFromMax").text();


        

            noUiSlider.create(slider3, {
                start: [parseInt(yearFromMin), parseInt(yearFromMax)],
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

            slider3.noUiSlider.on('update', function( values, handle ) {

                var value = values[handle];


                if ( handle ) {
                    yearTo.val(value);
                    $(".yearsTo").text(value);
                } else {
                    yearFrom.val(value);
                    $(".yearsFrom").text(value);
                }
            });
        

    }

    //

    ////fromstyler
    $('.checkboxInput').styler();


    ////fromstyler
    $('.checkboxInput').styler();


    //////tabs single item
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');

        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();

        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

        e.preventDefault();
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
        //$("#rightSearchFilter").submit();
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
    //sort_selects($('#marks .markOption'));
    //sort_selects($('#models .modelOption'));
    //sort_selects($('#fuel .fuelOption'));
    //sort_selects($('#caroserie .caroserieOption'));
    sort_selects_asc($('#power .powerOption'));


function get_models(brand_id){
   
     var url = $(".urlAjaxFilter").text();

    var data = {
        action: 'models_ajax_action',
        brand_id: brand_id,

    };

    $.ajax({
    url: ajaxurl,
    data: data,
    type: 'POST',
    success: function(response) {
   
        console.log(response);
       $("#models .modelOption").remove();
        $("#models").append(response);
       
    }
});

}

    $("#marks").change(function(){

        get_models($(this).val());

    });



    /////Kilometerstand noUi slider
    var $sidebarFilters = $('.sidebarFilters');
    if( $sidebarFilters.length ) {
        var sliderA = document.getElementById('sliderA');
        var kmFrom = $(".kmFrom");
        var kmto = $(".kmTo");

        var kmFromLabel = $(".kmFromLabel").text();
        var kmToLabel = $(".kmToLabel").text();

        var kmFromMin = $(".kmFromMin").text();
        var kmFromMax = $(".kmFromMax").text();

        if(kmFromMin == '') {
            kmFromMin = 0;
            kmFromLabel = 0;
        }



        if(sliderA) {
            if (sliderA) {
                noUiSlider.create(sliderA, {
                    start: [parseInt(kmFromMin), parseInt(kmFromMax)],
                    connect: true,
                    step:50,
                    range: {
                         'min': parseInt(kmFromLabel),
                         'max': parseInt(kmToLabel)
                       
                    },
                    format: wNumb({
                        decimals: 0,
                        thousand: '.'
                    })
                });

                sliderA.noUiSlider.on('update', function (values, handle) {

                    var value = values[handle];

                    var Format = wNumb({
                        
                        decimals: 0,
                        thousand: '.'
                    });

                    if (handle) {
                        kmto.val(value);
                        $(".kmToLabel").text(value);
                
                    } else {
                        kmFrom.val(value);
                        $(".kmFromLabel").text(value);
                    }
                });
            }
        }
    }


    ////////////hide show moree options
    $("#moreOptions > a").click(function(e) {
        e.preventDefault();
        $("#hiddenOptions").slideToggle("fast", function() {
            $("#moreOptions > a ").toggleClass("");
        });

    });

    var sidebarTextArea = $(".sidebarContent textarea");
    if(sidebarTextArea){
        var content = $(".sidebarContent .concatFormText").text();
        content.trim();
        sidebarTextArea.text(content);
    }


    $(document).on("click", ".b4uPrintButton", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.print();

    });

    $(".atGoBackButton").click(function(e){
        e.preventDefault();
        window.history.back();

    });

    //    Breadcrumb NavXT creator

    var breadcrumb = $(".breadcrumbs span[property='itemListElement']:last");
    if(breadcrumb){
        
        var structure = breadcrumb.clone();
        
        var car_title = $(".carTitleTop").text();
        if(car_title != ''){
            structure.find("span").text(car_title);
            var position = structure.find("meta").attr('content');
            structure.find("meta").attr('content',parseInt(position) + 1);
            $(".breadcrumbs").append(structure.prop('outerHTML'));
        }

        // console.log(structure);
  
    }

    // Contact form validate

    $('.submitButton').on('click',function(e){
        e.preventDefault();
        var input_email = $("#input_email"),
            input_name = $("#input_name");
          if(input_name.val() == ""){
              input_name.addClass('error_input');  
          }else{
              input_name.removeClass('error_input');  
          }

          if(input_email.val() == ""){
              input_email.addClass('error_input');  
          }else{
              input_email.removeClass('error_input');  
          }

          if(input_name.val() != "" && input_email.val() != ""){
            $(".autotrack_contact_form").submit();
          }   

    });



});