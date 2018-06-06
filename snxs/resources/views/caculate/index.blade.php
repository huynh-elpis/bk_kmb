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
    </style>
	<h1>Full Caculation: {{ $latestDate }}</h1>
    <h2 class="mg-header" >
        @if(!empty($pre))
            <span>|</span>
            @foreach($pre as $val)
                <span>{{ $val }}|</span>
            @endforeach
        @endif
        <label>~</label>
        @if(!empty($last))
            <span>|</span>
            @foreach($last as $val)
                <span>{{ $val }}|</span>
            @endforeach
        @endif
    </h2>
    <div>
        <div class="left-col">
            <div class="last left-col mg-25">
                <div>Pre-LAST:</div>
                <table>
                    <tr>
                        <td>No.</td>
                        <td>Total</td>
                    </tr>
                    @foreach($calculatePreLast as $key => $val)
                        <tr>
                            <td>{{  $key }}</td>
                            <td>{{ $val }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <?php /* <div class="pre-last right-col mg-25">
                <div>Pre-RECENT:</div>
                <table>
                    <tr>
                        <td>No.</td>
                        <td>Total</td>
                    </tr>
                    @foreach($calculatePreRecent as $key => $val)
                        <tr>
                            <td>{{  $key }}</td>
                            <td>{{ $val }}</td>
                        </tr>
                    @endforeach
                </table>
            </div> */ ?>
            <div class="pre-last right-col mg-25">
                <div>Pre-Longest:</div>
                <table>
                    <tr>
                        <td>No.</td>
                        <td>Points</td>
                    </tr>
                    @foreach($caculateLongestTenPreDes as $key => $val)
                        <tr>
                            <td>{{  $key }}</td>
                            <td>{{ $val }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="right-col">
            <div class="last left-col mg-25">
                <div>LAST:</div>
                <table>
                    <tr>
                        <td>No.</td>
                        <td>Total</td>
                    </tr>
                    @foreach($calculateLast as $key => $val)
                        <tr>
                            <td>{{  $key }}</td>
                            <td>{{ $val }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="last right-col mg-25">
                <div>Longest hundred:</div>
                <table>
                    <tr>
                        <td>No.</td>
                        <td>Points</td>
                    </tr>
                    @foreach($caculateLongestHundredDes as $key => $val)
                        <tr>
                            <td>{{  $key }}</td>
                            <td>{{ $val }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
    <?php /* <div class="pre-last right-col mg-25">
                <div>RECENT:</div>
                <table>
                    <tr>
                        <td>No.</td>
                        <td>Total</td>
                    </tr>
                    @foreach($calculateRecent as $key => $val)
                        <tr>
                            <td>{{  $key }}</td>
                            <td>{{ $val }}</td>
                        </tr>
                    @endforeach
                </table>
            </div> */ ?>
            <div class="last right-col mg-25">
                <div>LAST Hundred:</div>
                <table>
                    <tr>
                        <td>No.</td>
                        <td>Total</td>
                    </tr>
                    @foreach($caculateHundred as $key => $val)
                        <tr>
                            <td>{{  $key }}</td>
                            <td>{{ $val }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        <div class="last right-col mg-25">
                <div>Longest:</div>
                <table>
                    <tr>
                        <td>No.</td>
                        <td>Points</td>
                    </tr>
                    @foreach($caculateLongestTenDes as $key => $val)
                        <tr>
                            <td>{{  $key }}</td>
                            <td>{{ $val }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection