$(document).ready(function(){
    $('.switch-checkbox').each(function(){
        $(this).click(function(){
            
            let employee_id = $(this).attr('id');
            console.log(employee_id);
            $('#form-'+employee_id).submit();
        });
    });
});
