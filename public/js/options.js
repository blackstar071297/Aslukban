$(document).ready(function(){
    
    $('#option_btn').click(function(e){
        e.preventDefault();
        let hidden_name = $('<input>').attr('type','text').attr('name','option_name[]');
        let hidden_price = $('<input>').attr('type','number').attr('name','option_price[]');
        let delete_button = $('<a>').attr('href','').attr('class',' red-text delete');
        let icon = $('<i>').attr('class','material-icons').text('delete');
        delete_button.append(icon);

        let name_td = $('<td>');
        let price_td = $('<td>');
        let button_td = $('<td>');
        
        let tr = $('<tr>');
        name_td.append(hidden_name);
        price_td.append(hidden_price);
        button_td.append(delete_button);

        tr.append(name_td);
        tr.append(price_td);
        tr.append(button_td);

        $('#table-row').append(tr); 
    });
    $('#options_select').change(function(){
        $.ajax({
            type: 'get',
            url: '/option-price',
            data: {option: $(this).val()},
            success: function($data){
                console.log($data);
                $('#product_price_txt').text('P'+$data);
                $('#product_price').val($data);
            }
        });

    });
    
});
$(document).on('click','.delete', function(e){
    e.preventDefault();
    $(this).closest('tr').remove();
});
