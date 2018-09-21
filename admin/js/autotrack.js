$=jQuery;
$(document).ready(function(){
/*
    $("#colorpicker").spectrum({
        color: "#f00",
        flat: false,
        showInput: true,
        allowEmpty:true
    });*/

    $(".showUserPassFields").click(function(e){
        e.preventDefault();

        $(".usernameApi").toggle("linear");
        $(".passwprdApi").toggle("linear");


    });

    function update_ordering(){
        block_ordering = [];
        $('#sortable_details li').each(function(){
            state_block = $(this).find('.switch-button-background');
            state_val = state_block.hasClass('checked') ? '1' : '0';
            block_ordering.push({
                name: $(this).find('.lbText').text(),
                state:state_val
            });
        });
        //console.log(block_ordering);
        block_ordering = JSON.stringify(block_ordering);
        $('#block_ordering').val(block_ordering);
       
    }


    $( "#sortable_details" ).sortable({
        update: function(event, ui){
        
            update_ordering()
        }
    });


    $( "#sortable_details" ).disableSelection();


    $(document).on('click', '.erButton', function(){
        container = $(this).closest('.eMailsRepeater');
        last_row = container.find('.eRow:last').index();
        this_row = $(this).parent().index();

        if(this_row == last_row && this_row != 0){

                $(this).parent().remove();

        }else{

            this_line = $(this).parent();
            new_row = this_line.clone();
            new_row.find('input').val('');
            new_row.insertAfter(this_line);

        }
    });


    var custom_uploader;
    $(document).on('click', '.uploadSocialIcon', function(e){
        e.preventDefault();
        click_elem = $(this);
        this_row = click_elem.closest('.atSIRow');

        //target = $('.wrap input[name="logo"]');

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            //console.log('heeelloo1');
            attachment = custom_uploader.state().get('selection').first().toJSON();
            //console.log('heeelloo2');
            this_row.find('.iconHolder').html('<img src="'+attachment.url +'">');
            $('#at_social_icons').val(build_socials());
            //target.attr('value', attachment.url);
            //target.attr('type', 'file');
            //console.log(build_socials());
        });
        //Open the uploader dialog
        custom_uploader.open();
    });

    function build_socials(){
        socials = [];
        $('.atSocialIcons .atSIRow').each(function(){
            state_block = $(this).find('.switch-button-background');
            state_val = state_block.hasClass('checked') ? '1' : '0';
            socials.push({
                name: $(this).find('.atSIName').text(),
                active:state_val,
                url:$(this).find(".atSIinput").val(),
                icon_url: $(this).find('.iconHolder img').attr('src')
            });

        });
        return JSON.stringify(socials);
    }

    function changeSwitcherSocial(){

        $('.atSocialIcons .atSIRow').each(function(){
            state_block = $(this).find('.atSIurl .switch-button-background');
            state_val = state_block.hasClass('checked') ? '1' : '0';
            $(this).find(".atSIinput").val(state_val);

        });
    }


    //orar

    function build_shedule(){
        shedule = [];

        $('.geef .gRow').each(function(){
            shedule.push({
                day: $(this).find('.gDay').text(),
                time1: ($(this).find('.gOrar1 .from').val() && $(this).find('.gOrar1 .to').val()) ? {
                    from:   $(this).find('.gOrar1 .from').val(),
                    to:     $(this).find('.gOrar1 .to').val()
                }: undefined,

                time2: ($(this).find('.gOrar2 .from').val() && $(this).find('.gOrar2 .to').val()) ? {
                    from:   $(this).find('.gOrar2 .from').val(),
                    to:     $(this).find('.gOrar2 .to').val()
                } : undefined
            })
        });
        return shedule;
    }
    $(document).on('change, keypress, keyup', '.gRow input', function(){
        $('#shedule').val(JSON.stringify(build_shedule()));

    });

    $(document).on('click', '.gOrar1 .gButton', function(){
        $(this).closest('.gRow').find('.gOrar2').css('visibility', 'visible');
    });

    $(document).on('click', '.gOrar2 .gButton', function(){
        $(this).parent().css('visibility', 'hidden');
        $(this).siblings().val('');
        $('#shedule').val(JSON.stringify(build_shedule()));
    });


    $('.lbSwither input[type="checkbox"]').switchButton({
        on_label: '',
        off_label: '',
        width: 50,
        height: 25,
        button_width: 25,
        on_callback: function(){
            //console.log('on');
            build_socials();
            update_ordering()
        },
        off_callback: function(){
            //console.log('off');
            build_socials();
            update_ordering()
        }
    });

    $('.socialSwither input[type="checkbox"]').switchButton({
        on_label: '',
        off_label: '',
        width: 50,
        height: 25,
        button_width: 25,
        on_callback: function(){
            //console.log('on');
            $('#at_social_icons').val(build_socials());
        },
        off_callback: function(){
            //console.log('off');
            $('#at_social_icons').val(build_socials());
        }
    });



    $("#allAttr").on('click','.checkField',function(e){
        var url = $(".urlAjax").text();
        var id = $(this).attr('data-id');
        var name = $(this).attr('name');
        var val_point = "0";
        var event = e;
        if($(this).is(":checked"))
        {
            val_point = "1";
            var data = {
                action: 'test_response',
                id: id,
                name: name,
                val_point: val_point
            };
            $.post(ajaxurl,data, function(response) {
                console.log(response);
                if(event.screenX && event.screenX != 0 && event.screenY && event.screenY != 0){

                    swal({
                        title: "",
                        text: "De instellingen zijn succesvol opgeslagen.",
                        timer: 1000,
                        showConfirmButton: false,
                        type:"success",
                    });
                }else{

                }


            });


        }else
        {
            val_point = "0";
            var data = {
                action: 'test_response',
                id: id,
                name: name,
                val_point: val_point
            };
            $.post(ajaxurl,data, function(response) {
                if(event.screenX && event.screenX != 0 && event.screenY && event.screenY != 0){
                    swal({
                        title: "",
                        text: "De instellingen zijn succesvol opgeslagen.",
                        timer: 1000,
                        showConfirmButton: false,
                        type:"success",
                    });
                }else{

                }

            });

        }
    });


    function selectDeselectAll(id,val_point,name,counter){
        $(".loader").show();

        var url = $(".urlAjax").text();
        var data = {
            action: 'test_response_sel_des',
            id_s: id,
            name: name,
            val_point: val_point
        };
        $.post(ajaxurl,data, function(response) {
            console.log(response);

            $(".loader").hide();
            swal({
                title: "",
                text: "De instellingen zijn succesvol opgeslagen.",
                timer: 1000,
                showConfirmButton: false,
                type:"success",
            });

        });

        }



    $(".selectUnselectField").click(function(){
        if($(this).prop('checked'))
        {
            var name = $(this).attr('name');
            var id_s = "";
            var counter = 0;
            $("#allAttr ."+$(this).attr('name')).each(function(){

                    if($(this).prop('checked')){

                    }else{

                        $(this).prop('checked', true);
                        var id = $(this).attr('data-id');
                        //$(this).trigger( "click" );
                        id_s = id_s.concat("+"+id);
                        //console.log(id_s);

                    }
            });
            selectDeselectAll(id_s,'1',name);
        }else{
            var name = $(this).attr('name');
            var id_s = "";
            $("#allAttr ."+$(this).attr('name')).each(function(){

                if($(this).prop('checked')){
                    $(this).prop('checked', false);
                    var id = $(this).attr('data-id');
                    //$(this).trigger( "click" );
                    id_s = id_s.concat("+"+id);
                    //console.log(id_s);

                }else{

                }


            });
            selectDeselectAll(id_s,'0',name);

        }

    });

    function filter_attr(category,attr_name,home_page,overview,summary_detail,details_total)
    {
        var url = $(".urlAjax").text();

        var data = {
            action: 'filter_attributes',
            name: name,
            category: category,
            attr_name: attr_name,
            home_page: home_page,
            overview: overview,
            summary_detail: summary_detail,
            details_total: details_total
        };
        $.post(ajaxurl,data, function(response) {
           
            $("#allAttr tr").remove();
            $("#allAttr").append(response);
        });
    }

    $("#categoryFilter").change(function(){
        var category = $("#categoryFilter").val();
        var attr_name = $(".attribute_name").val();
        var home_page = $("#home_page_filter").val();
        var overview = $("#overview_filter").val();
        var summary_detail = $("#summary_detail_filter").val();
        var details_total = $("#details_total").val();
        filter_attr(category,attr_name,home_page,overview,summary_detail,details_total);
    });

    $(".attribute_name").focusout(function(){
        var category = $("#categoryFilter").val();
        var attr_name = $(".attribute_name").val();
        var home_page = $("#home_page_filter").val();
        var overview = $("#overview_filter").val();
        var summary_detail = $("#summary_detail_filter").val();
        var details_total = $("#details_total").val();
        filter_attr(category,attr_name,home_page,overview,summary_detail,details_total);
    });

    $(".attribute_name").keypress(function(e){
        if(e.keyCode == 13)
        {
            e.preventDefault();
            var category = $("#categoryFilter").val();
            var attr_name = $(".attribute_name").val();
            var home_page = $("#home_page_filter").val();
            var overview = $("#overview_filter").val();
            var summary_detail = $("#summary_detail_filter").val();
            var details_total = $("#details_total").val();
            filter_attr(category,attr_name,home_page,overview,summary_detail,details_total);
        }
    });

    $("#home_page_filter").change(function(){
        var category = $("#categoryFilter").val();
        var attr_name = $(".attribute_name").val();
        var home_page = $("#home_page_filter").val();
        var overview = $("#overview_filter").val();
        var summary_detail = $("#summary_detail_filter").val();
        var details_total = $("#details_total").val();
        filter_attr(category,attr_name,home_page,overview,summary_detail,details_total);
    });

    $("#overview_filter").change(function(){
        var category = $("#categoryFilter").val();
        var attr_name = $(".attribute_name").val();
        var home_page = $("#home_page_filter").val();
        var overview = $("#overview_filter").val();
        var summary_detail = $("#summary_detail_filter").val();
        var details_total = $("#details_total").val();
        filter_attr(category,attr_name,home_page,overview,summary_detail,details_total);
    });

    $("#summary_detail_filter").change(function(){
        var category = $("#categoryFilter").val();
        var attr_name = $(".attribute_name").val();
        var home_page = $("#home_page_filter").val();
        var overview = $("#overview_filter").val();
        var summary_detail = $("#summary_detail_filter").val();
        var details_total = $("#details_total").val();
        filter_attr(category,attr_name,home_page,overview,summary_detail,details_total);
    });

    $("#details_total").change(function(){
        var category = $("#categoryFilter").val();
        var attr_name = $(".attribute_name").val();
        var home_page = $("#home_page_filter").val();
        var overview = $("#overview_filter").val();
        var summary_detail = $("#summary_detail_filter").val();
        var details_total = $("#details_total").val();
        filter_attr(category,attr_name,home_page,overview,summary_detail,details_total);
    });

    $(".settingSubmitButton").click(function(e){


        swal({
            title: "",
            text: "De instellingen zijn succesvol opgeslagen.",
            showConfirmButton: false,
            type:"success",
            timer: 1000
        });
        $("#settingsForm").submit();





    });

    $(".delete_icon").click(function(e){
        e.preventDefault();
        $(this).parent().parent().find("img").remove();
        $('#at_social_icons').val(build_socials());
    });


    $(".thxPage").change(function(){
        console.log($(this).val());

        if($(this).val() == 'thx_page'){
            $(".at_thank_you_textLabel").slideUp();
            $(".at_thank_you_text").slideUp();

            $(".at_link_to_thx_pageLabel").slideDown();
            $(".at_link_to_thx_page").slideDown();

        }else{
        $(".at_thank_you_textLabel").slideDown();
            $(".at_thank_you_text").slideDown();

            $(".at_link_to_thx_pageLabel").slideUp();
            $(".at_link_to_thx_page").slideUp();
        }
    });




});