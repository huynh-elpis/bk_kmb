<?php

namespace snxs\Http\Controllers;

use Illuminate\Http\Request;
use View;
use DB;
use snxs\Http\Requests;
use snxs\Http\Controllers\Controller;

class CaculateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $city=0)
    {
        //if(empty($city)) $city=date('w', time());
        $kqsRecent = DB::table('xs')
            ->where('city',$city)
            ->orderBy('date','desc')
            ->limit(50)
            ->get();

        $kqs = DB::table('xs')->where('city',$city)->get();

        $calculateFull = $this->dbToArray($kqs);
        $calculateRecentFull = $this->dbToArray($kqsRecent, false);
        $calculateLast = $calculateFull['last'];
        $calculatePreLast = $calculateFull['pre_last'];
        $calculateRecent = $calculateRecentFull['last'];
        $calculatePreRecent = $calculateRecentFull['pre_last'];
        $last = $this->calculateBestChoice($calculateLast, $calculateRecent);
        $pre = $this->calculateBestChoice($calculatePreLast, $calculatePreRecent);
        return View("caculate.index", compact([
            'calculateLast',
            'calculatePreLast',
            'calculateRecent',
            'calculatePreRecent',
            'last',
            'pre',
        ]));

    }
    private function calculateBestChoice($full, $recent)
    {
        $f = $this->getFirstTwo($full);
        $r = $this->getFirstTwo($recent);
        $res=[];
        foreach ($f as $val){
            if (in_array($val, $r)) {
                $res[] = $val;
            }
        }
        return $res;
    }
    private function getFirstTwo($arr){
        $cnt = 0;
        $r=[];
        foreach($arr as $key=>$m){
            $r[] = $key;
            $cnt++;
            if($cnt>=3) break;
        }
        return $r;
    }
    private function dbToArray($kqs, $asc=true)
    {
        $calculateLast = [];
        $calculatePreLast = [];
        foreach($kqs as $kq){
            $last = substr($kq->value, -1, 1);
            $preLast = substr($kq->value, -2, 1);
            if(empty($calculateLast[$last])) {
                $calculateLast[$last] = 1;
            } else {
                $calculateLast[$last] = $calculateLast[$last] + 1;
            }
            if(empty($calculatePreLast[$preLast])) {
                $calculatePreLast[$preLast] = 1;
            } else {
                $calculatePreLast[$preLast] = $calculatePreLast[$preLast] + 1;
            }
        }
        if($asc){
            asort($calculateLast);
            asort($calculatePreLast);
        }else{
            arsort($calculateLast);
            arsort($calculatePreLast);
        }

        return ['last' => $calculateLast, 'pre_last' => $calculatePreLast];
    }
}
