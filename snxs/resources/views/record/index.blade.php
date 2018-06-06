@extends('layout')


@section('content')
    <style>
        .left-col{
            float:left;
        }
        .right-col{
            float:right;
        }
        .mg-25{
            margin: 25px;
        }
        .mg-header{
            margin-left: 30%;
            margin-top: 30px;
            margin-bottom: 25px;
        }
        td:first-child {
            background-color: #ccc;
        }
        .notice-color{
            color: #880000;
        }
    </style>
	<h1>Record Caculation</h1>
    <h2 class="mg-header" >
        @if(!empty($recordList))
            <span>Record:</span>
            @foreach($recordList as $key => $val)
                @if ($currentLongest[$key] >= $val)
                    <span class="{{ $currentLongest[$key] > $val ? 'notice-color' : '' }}">{{ $val }}|</span>
                @endif
            @endforeach
        @endif
    </h2>
@endsection