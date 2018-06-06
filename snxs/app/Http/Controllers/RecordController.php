<?php

namespace snxs\Http\Controllers;

use Illuminate\Http\Request;
use View;
use DB;
use snxs\Http\Requests;
use snxs\Http\Controllers\Controller;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $city)
    {
        echo floor(36 / 18);
        die;
        //set_time_limit(-1);
        ini_set('max_excution_time', 3600);
        $recordList = $this->caculateRecord($city);
        $currentLongest = $this->caculateCurrentLongest($city);
        return View("record.index", compact([
             'recordList','currentLongest'
        ]));

    }
    private function generateDefaultRecord($to)
    {
        $res = [];
        for($i = 0; $i < $to; $i++){
            $res[] = 0;
        }
        return $res;
    }
    private function caculateRecord($city)
    {
        $res = $this->generateDefaultRecord(100);
        $today = date('Y-m-d');
        for($i = 0; $i < 100; $i++){
            echo $i;
            $res[$i] = $this->caculateRecordOfNumber($i, 0, $today, $city);
        }
        return $res;
    }
    private function caculateRecordOfNumber($num, $record, $from, $city)
    {
        $kqsRecentQuery = DB::table('xs')->where('city',$city)
            ->where('avail_flg','=','1')
            ->where('date', '<', $from)
            ->orderBy('date','desc')->get();
        $count = 0;
        $findDate = '';
        foreach($kqsRecentQuery as $item){
            $val = substr($item->value, -2, 2);
            if(intVal($val) == $num){
                $findDate = $item->date;
                break;
            }
            $count ++;
        }
        $noOfDay = floor($count / 18);
        $newRecord =  $noOfDay > $record ? $noOfDay : $record;
        if(empty($findDate) || empty($count)){
            return $newRecord;
        }
        return $this->caculateRecordOfNumber($num, $newRecord, $findDate, $city);
    }
    private function caculateCurrentLongest($city)
    {
        $res = $this->generateDefaultRecord(100);
        $today = date('Y-m-d');
        for($i = 0; $i < 100; $i++){
            $res[$i] = $this->caculateCurrentLongestOfNumber($i, $today, $city);
        }
        return $res;
    }
    private function caculateCurrentLongestOfNumber($num, $from, $city)
    {
        $kqsRecentQuery = DB::table('xs')->where('city',$city)
            ->where('avail_flg','=','1')
            ->where('date', '<', $from)
            ->orderBy('date','desc')->get();
        $count = 0;
        foreach($kqsRecentQuery as $item){
            $val = substr($item->value, -2, 2);
            if(intVal($val) == $num){
                return floor($count / 18);
            }
            $count ++;
        }
    }
}
