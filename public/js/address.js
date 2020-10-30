$(document).ready(function(){

    $('#provinces').change(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        $.ajax({
            type: 'get',
            url: '/city',
            data: {province_code: $('#provinces option:selected').val()},
            success: function($data){
                
                let sortedArray = [];
                for(var i in $data)
                {
                    sortedArray.push([i, $data[i]]);
                }
                sortedArray.sort(SortByCity);
                $('#city').empty();
                let disabled = $('<option>').attr('disabled',true).attr("selected", "selected").text('Select City');
                $('#city').append(disabled);
                $("#city").formSelect()
                for(let i = 0;i < sortedArray.length;i++){
                    // console.log(sortedArray[i][1]['city_municipality_description']);
                    let option = $('<option>').val(sortedArray[i][1]['city_municipality_code']).text(sortedArray[i][1]['city_municipality_description']);

                    $('#city').append(option)
                    $("#city").formSelect()
                }
               
            }
        })
    });
    $('#city').change(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        $.ajax({
            type: 'get',
            url: '/barangay',
            data: {province_code: $('#provinces option:selected').val(),city_municipality_code:$('#city option:selected').val()},
            success: function($data){

                
                let sortedArray = [];
                for(var i in $data)
                {
                    sortedArray.push([i, $data[i]]);
                }
                sortedArray.sort(SortByBarangay);
                $('#barangay').empty();
                let disabled = $('<option>').attr('disabled',true).attr("selected", "selected").text('Select Baranggay');
                $('#barangay').append(disabled);
                $("#barangay").formSelect()
               
                for(let i = 0;i < sortedArray.length;i++){
                    console.log(sortedArray[0][1]['barangay_code']);
                    let option = $('<option>').val(sortedArray[i][1]['barangay_code']).text(sortedArray[i][1]['barangay_description']);
                    $('#barangay').append(option)
                    $("#barangay").formSelect()
                }
               
            }
        })
    });
    //Comparer Function    
    function SortByCity(x,y) {
        return ((x[1].city_municipality_description == y[1].city_municipality_description) ? 0 : ((x[1].city_municipality_description > y[1].city_municipality_description) ? 1 : -1 ));
    }
    function SortByBarangay(x,y) {
        return ((x[1].barangay_description == y[1].barangay_description) ? 0 : ((x[1].barangay_description > y[1].barangay_description) ? 1 : -1 ));
    }
});
