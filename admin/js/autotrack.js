$=jQuery;
$(document).ready(function(){

    $("#allAttr").on('click','.checkField',function(){
        var url = $(".urlAjax").text();
        var id = $(this).attr('data-id');
        var name = $(this).attr('name');
        var val_point = "0";
        if($(this).is(":checked"))
        {
            val_point = "1";
            var data = {
                action: 'test_response',
                id: id,
                name: name,
                val_point: val_point
            };
            $.post(url,data, function(response) {

            });
            console.log(val_point);

        }else
        {
            val_point = "0";
            var data = {
                action: 'test_response',
                id: id,
                name: name,
                val_point: val_point
            };
            $.post(url,data, function(response) {

            });
            console.log(val_point);
        }
    });


    $(".selectUnselectField").click(function(){
        if($(this).is(":checked"))
        {
            $("#allAttr ."+$(this).attr('name')).each(function(){
                if($(this).is(":checked"))
                {

                }else
                {
                    $(this).prop('checked', false);
                    $(this).trigger( "click" );
                }

            });
        }else{
            $("#allAttr ."+$(this).attr('name')).each(function(){
               if($(this).is(":checked"))
               {
                   $(this).prop('checked', true);
                   $(this).trigger( "click" );
               }else
               {

               }

            });

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
        $.post(url,data, function(response) {
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


});