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
     * Equal Rule
     * @return \Illuminate\Http\Response
     */
    public function headOnly(Request $request, $city=0)
    {
        //if(empty($city)) $city=date('w', time());
        $kqsQuery = DB::table('xs')->where('city',$city)
        ->where('avail_flg','=','1')
        ->whereRaw('LENGTH(value) = 2');
        $kqsRecentQuery = DB::table('xs')->where('city',$city)
            ->where('avail_flg','=','1')
            ->whereRaw('LENGTH(value) = 2')->orderBy('date','desc');
        $kqLongest = DB::table('xs')->where('city',$city)
            ->where('avail_flg','=','1')
            ->whereRaw('LENGTH(value) = 2')->orderBy('date','desc')->get();

        $kqs = $kqsQuery->get();
		//$kqsRecent = $kqsRecentQuery->limit(54)->get();
		
        $calculateFull = $this->dbToArray($kqs);
        $caculateHundred = $this->dbToArrayHundred($kqs);
       // $calculateRecentFull = $this->dbToArray($kqsRecent, false);
        $calculateLast = $calculateFull['last'];
        $calculatePreLast = $calculateFull['pre_last'];
        /*$calculateRecent = $calculateRecentFull['last'];
        $calculatePreRecent = $calculateRecentFull['pre_last'];
        */

		$latestDate = $kqsRecentQuery->first()->date;

        /* caculate longest Ten not apear*/
        $caculateLongestTen = $this->caculateLongestTen($kqLongest); //print_r($caculateLongestTen); die;
        $caculateLongestTenDes = [];
        $caculateLongestTenPreDes = [];
        $t3 = 0;
        foreach($caculateLongestTen['des'] as $k => $des){
          $caculateLongestTenDes[$k] = $des;
          $t3 ++;
          if($t3 >= 10) break;
        }
        $t3 = 0;
        foreach($caculateLongestTen['pre_des'] as $k => $des){
          $caculateLongestTenPreDes[$k] = $des;
          $t3 ++;
          if($t3 >= 10) break;
        }

        /* caculate longest hundred not apear*/
        $caculateLongestHundred = $this->caculateLongestHundred($kqLongest); //print_r($caculateLongestTen); die;
        $caculateLongestHundredDes = [];
        $t3 = 0;
        foreach($caculateLongestHundred['des'] as $k => $des){
          $caculateLongestHundredDes[$k] = $des;
          $t3 ++;
          if($t3 >= 100) break;
        }

        $last = $this->calculateBestChoice($calculateLast, /*$calculateRecent,*/ $caculateLongestTenDes);
        $pre = $this->calculateBestChoice($calculatePreLast, /*$calculatePreRecent,*/ $caculateLongestTenPreDes);

        return View("caculate.headOnly", compact([
            'calculateLast',
            'calculatePreLast',
            /*'calculateRecent',
            'calculatePreRecent',*/
            'caculateHundred',
            'last',
            'pre',
			'latestDate',
      'caculateLongestTenDes','caculateLongestTenPreDes','caculateLongestHundredDes'
        ]));

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $city=0)
    {
        //if(empty($city)) $city=date('w', time());
        $kqsQuery = DB::table('xs')->where('city',$city)->where('avail_flg','=','1');
        $kqsRecentQuery = DB::table('xs')->where('city',$city)->where('avail_flg','=','1')->orderBy('date','desc');
        $kqLongest = DB::table('xs')->where('city',$city)->where('avail_flg','=','1')->orderBy('date','desc')->get();

        $kqs = $kqsQuery->get();
        //$kqsRecent = $kqsRecentQuery->limit(54)->get();

        $calculateFull = $this->dbToArray($kqs);
        $caculateHundred = $this->dbToArrayHundred($kqs);
        
        //$calculateRecentFull = $this->dbToArray($kqsRecent, false);
        
        $calculateLast = $calculateFull['last'];
        $calculatePreLast = $calculateFull['pre_last'];
        
        //$calculateRecent = $calculateRecentFull['last'];
        //$calculatePreRecent = $calculateRecentFull['pre_last'];

        $latestDate = $kqsRecentQuery->first()->date;

        /* caculate longest ten not apear*/
        $caculateLongestTen = $this->caculateLongestTen($kqLongest);
        $caculateLongestTenDes = [];
        $caculateLongestTenPreDes = [];
        $t3 = 0;
        foreach($caculateLongestTen['des'] as $k => $des){
          $caculateLongestTenDes[$k] = $des;
          $t3 ++;
          if($t3 >= 10) break;
        }
        $t3 = 0;
        foreach($caculateLongestTen['pre_des'] as $k => $des){
          $caculateLongestTenPreDes[$k] = $des;
          $t3 ++;
          if($t3 >= 10) break;
        }
        /* caculate longest hundred not apear*/
        $caculateLongestHundred = $this->caculateLongestHundred($kqLongest); //print_r($caculateLongestTen); die;
        $caculateLongestHundredDes = [];
        $t3 = 0;
        foreach($caculateLongestHundred['des'] as $k => $des){
            $caculateLongestHundredDes[$k] = $des;
            $t3 ++;
            if($t3 >= 100) break;
        }

        $last = $this->calculateBestChoice($calculateLast, /*$calculateRecent,*/ $caculateLongestTenDes);
        $pre = $this->calculateBestChoice($calculatePreLast, /*$calculatePreRecent,*/ $caculateLongestTenPreDes);

        return View("caculate.index", compact([
            'calculateLast',
            'calculatePreLast',
            /*'calculateRecent',
            'calculatePreRecent',*/
            'caculateHundred',
            'last',
            'pre',
			'latestDate',
      'caculateLongestTenDes','caculateLongestTenPreDes','caculateLongestHundredDes'
        ]));

    }
    private function generateDefaultLongest($to)
    {
      $res = [];
      for($i = 0; $i < $to; $i++){
        $res[] = 0;
      }
      return $res;
    }
    private function validLongest($data)
    {
      foreach($data as $item)
      {
        if(empty($item)){
          return false;
        }
      }
      return true;
    }
    private function caculateLongestTen($data)
    {
      $des = 10;
      $preDes = 10;
      
      $longestPoint = $this->generateDefaultLongest($des);
      $preLongestPoint = $this->generateDefaultLongest($preDes);
      
      foreach($data as $item){
          $last = substr($item->value, -1, 1);
          if(!$this->validLongest($longestPoint)){
            $longestPoint[intVal($last)] = $longestPoint[intVal($last)] + 1;
          }
          if($this->validLongest($longestPoint)){
            $longestPoint[intVal($last)] = $longestPoint[intVal($last)] - 1;
            break;
          }
      }
      foreach($data as $item){
          $preLast = substr($item->value, -2, 1);
          if(!$this->validLongest($preLongestPoint)){
            $preLongestPoint[intVal($preLast)] = $preLongestPoint[intVal($preLast)] + 1;
          }
          if($this->validLongest($preLongestPoint)){
            $preLongestPoint[intVal($preLast)] = $preLongestPoint[intVal($preLast)] - 1;
            break;
          }
      }
      asort($longestPoint);
      asort($preLongestPoint);
      return ['des' => $longestPoint, 'pre_des' => $preLongestPoint];
    }
    private function caculateLongestHundred($data)
    {
      $des = 100;
      
      $longestPoint = $this->generateDefaultLongest($des);
      foreach($data as $item){
          $val = substr($item->value, -2, 2);
          if(!$this->validLongest($longestPoint)){
            $longestPoint[intVal($val)] = $longestPoint[intVal($val)] + 1;
          }
          if($this->validLongest($longestPoint)){
            $longestPoint[intVal($val)] = $longestPoint[intVal($val)] - 1;
            break;
          }
      }      
      asort($longestPoint);
      return ['des' => $longestPoint];
      
    }
    private function calculateBestChoice($full, /*$recent,*/ $more=null)
    {
        $f = $this->getPriority($full);
        //$r = $this->getPriority($recent);
        $m = $this->getPriority($more, 1);
        $res=[];
        foreach ($m as $val){
            if (/*in_array($val, $r) && */in_array($val, $f)) {
                $res[] = $val;
            }
        }
        return $res;
    }
    private function getPriority($arr, $total=3){
        $cnt = 0;
        $r=[];
        foreach($arr as $key=>$m){
            $r[] = $key;
            $cnt++;
            if($cnt>=($total)) break;
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
    private function dbToArrayHundred($kqs)
    {
        $calculate = [];
        foreach($kqs as $kq){
            $last = substr($kq->value, -2, 2);
            if(empty($calculate[$last])) {
                $calculate[$last] = 1;
            } else {
                $calculate[$last] = $calculate[$last] + 1;
            }
        }
        asort($calculate);
        asort($calculate);

        return $calculate;
    }
}
