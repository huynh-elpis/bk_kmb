
@extends('layout')


@section('content')
    <style>
        .mg-header{
            margin-left: 30%;
            margin-top: 30px;
            margin-bottom: 25px;
        }
    </style>
    <h2 class="mg-header" >Today:</h2>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>lastest update</th>
                    <th>Action</th>
                    <th>Caculate</th>
                </tr>
            </thead>
            <tbody>
            @foreach($todayData as $item)
                <tr>
                    <td>{{ $item['id']?$item['id']:'' }}</td>
                    <td>{{$item['code']}}</td>
                    <td>{{$item['lastest']}}</td>
                    <td>
                        <a href="javascript:void(0);" onclick="return sendData({{ $item['id']?$item['id']:'' }});">SEND</a>
                    </td>
                    <td><a href="/caculate/equaly/{{ $item['id']?$item['id']:'' }}">Caculate</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <h2 class="mg-header" >Tomorrow:</h2>
    <div>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>lastest update</th>
                <th>Action</th>
                <th>Caculate</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tomorrowData as $item)
                <tr>
                    <td>{{ $item['id']?$item['id']:'' }}</td>
                    <td>{{$item['code']}}</td>
                    <td>{{$item['lastest']}}</td>
                    <td><a href="javascript:void(0);" onclick="return sendData({{ $item['id']?$item['id']:'' }});">SEND</a></td>
                    <td><a href="/caculate/equaly/{{ $item['id']?$item['id']:'' }}">Caculate</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
<form id="submit-rss" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" id="city-id" value=""/>
</form>
<script>
function sendData(id){
    $('#city-id').val(id);
    $('#submit-rss').submit();
}
</script>

@endsection