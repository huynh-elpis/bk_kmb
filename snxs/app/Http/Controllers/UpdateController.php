<?php

namespace snxs\Http\Controllers;

use Awjudd\FeedReader\FeedReader;
use Illuminate\Http\Request;

use DB;
use snxs\Http\Requests;
use snxs\Http\Controllers\Controller;


class UpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $city = config('master.city');
        $schedule = config('master.schedule');
        $rssRoot = config('master.rss_root');

        $todayWeek = date('w', time());
        $tomorrowWeek = date('w', strtotime('tomorrow'));
        $todaySchedule = $schedule[$todayWeek];
        $tomorrowSchedule = $schedule[$tomorrowWeek];

        if ($request->isMethod('post')) {
            $data = $request->all();
            if(!empty($data['id'])){
                $cityData = $city[$data['id']];
                $rss = (new FeedReader)->read($rssRoot . $cityData['rss']);
                $totalItem = $rss->get_item_quantity();
                for($i = 0; $i < $totalItem; $i++){
                    $item = $rss->get_item($i);
                    $link = $item->get_link();
                    $itemDates = explode('/',$link);
                    $itemDate = explode('.',$itemDates[count($itemDates)-1])[0];

                    //check if date exists.
                    $itemDateArr = explode('-',$itemDate);
                    $itemDate = $itemDateArr[2] . '-' . $itemDateArr[1] . '-' . $itemDateArr[0];
                    $checkExists = DB::table('xs')->where('city',$data['id'])
                        ->where('date','=',$itemDate)->count();
                    if($checkExists > 0){

                    } else {
                        $description = $item->get_description();
                        $description = str_replace(chr(10),' ',$description);
                        $descriptions = explode(' ', $description);

                        $descriptions[33] = substr($descriptions[33],0,3);
                        if(count($descriptions) < 35){
                            echo "data is lack: " . $description;
                        }else{
                            $kqValid = [1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31,33,34];
                            $kq = [];
                            foreach($kqValid as $v) $kq[] = $descriptions[$v];

                            foreach($kq as $newVal){
                                $newItem = [
                                    'city' => $data['id'],
                                    'date' => $itemDate,
                                    'value' => $newVal
                                ];
                                DB::table('xs')->insert($newItem);
                            }
                        }
                    }
                }
            }
        }

        $todayData = [];
        foreach($todaySchedule as $id){
            $code = $city[$id];
            $lastestUpdate = DB::table('xs')->where('city',$id)
                ->where('avail_flg','=','1')->orderBy('date','desc')->first()->date;
            $todayData[] = [
                'id' => $id,
                'code' => $code['code'],
                'lastest' => $lastestUpdate . '(' . date('D',time()) . ')'
            ];
        }
        $tomorrowData = [];
        foreach($tomorrowSchedule as $id){
            $code = $city[$id];
            $lastestUpdate = DB::table('xs')->where('city',$id)
                ->where('avail_flg','=','1')->orderBy('date','desc')->first()->date;
            $tomorrowData[] = [
                'id' => $id,
                'code' => $code['code'],
                'lastest' => $lastestUpdate . '(' . date('D',strtotime('tomorrow')) . ')'
            ];
        }
        //FeedReader::
        return View("update", compact([
            'todayData','tomorrowData'
        ]));
    }

}
