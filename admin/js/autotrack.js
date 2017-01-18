$=jQuery;
$(document).ready(function(){
/*
    $("#colorpicker").spectrum({
        color: "#f00",
        flat: false,
        showInput: true,
        allowEmpty:true
    });*/

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

    $('.lbSwither input[type="checkbox"]').switchButton({
        on_label: '',
        off_label: '',
        width: 50,
        height: 25,
        button_width: 25,
        on_callback: function(){
            //console.log('on');
            update_ordering();
        },
        off_callback: function(){
            //console.log('off');
            update_ordering();
        }
    });
});