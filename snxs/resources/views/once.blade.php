
@extends('layout')


@section('content')
    <style>
        div.vien{
            display:none;
        }
    </style>
    @extends('import.hcm0525')

<a href="javascript:void(0);" onclick="return sendData();">SEND</a>
<script>
function sendData(){
    var data=[];
    $('div.vien div.col-sm-6 table.kqcenter').each(function(index){
        var nDate = $(this).find('thead tr td span').html();
        $(this).find('tbody tr').each(function(idx2){
            var nItem = $(this).find('td').each(function(idx3){
                var nLevel = '';
                if(idx3 === 0){
                    nLevel = $(this).html();
                } else {
                    var nValue = $(this).html();
                    var newData = {
                        'date': nDate,
                        'level': nLevel,
                        'value': nValue
                    };
                    data.push(newData);
                }
            });
        });
    });

    $.ajax({
        type: 'post',
        url: '/once',
        data: JSON.stringify(data),
        //dataType:"json",
        contentType: "application/json",
        success: function(res){
            console.log(res);
        },
    });
}
</script>

@endsection