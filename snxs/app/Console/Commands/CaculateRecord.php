<?php

namespace snxs\Console\Commands;

use Illuminate\Console\Command;

use DB;

class CaculateRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'caculate:record {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $city = $this->argument('city');
        $recordList = $this->caculateRecord($city);
        echo "\r\n Longest....";
        $currentLongest = $this->caculateCurrentLongest($city);
        echo "\r\n Result:";
        echo "\r\n";
        $newCaculate = [];
        foreach($recordList as $key => $val){
            if ($currentLongest[$key] >= $val){
                if($currentLongest[$key] > $val){
                    $newCaculate[] = '(' . $key . ')';
                    echo '|' . $key . '|';
                }else{
                    $newCaculate[] = $key;
                    echo $key;
                }
                echo "\r\n";
            }
        }
        $fromDay = DB::table('xs')->where('city',$city)
            ->where('avail_flg','=','1')
            ->orderBy('date','desc')->first()->date;
        $checkExists = DB::table('record')->where('city',$city)
            ->where('avail_flg','=','1')
            ->where('caculate_date','=',$fromDay)->count();
        if($checkExists > 0){

        }else{
            $newRecord = [
                'city' => $city,
                'caculate_date' => $fromDay,
                'value' => implode("|",$newCaculate)
            ];
            DB::table('record')->insert($newRecord);
        }

        //
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
        $fromDay = DB::table('xs')->where('city',$city)
            ->where('avail_flg','=','1')
            ->orderBy('date','desc')->first()->date;
        $res = $this->generateDefaultRecord(100);
        for($i = 0; $i < 100; $i++){
            echo $i;
            $res[$i] = $this->caculateRecordOfNumber($i, 0, $fromDay, $city);
            echo ': ' . $res[$i] . "\r\n";
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
                $count ++;
                break;
            }
            $count ++;
        }
        $newRecord = floor($count / 18);
        if($newRecord < $record){
            $newRecord = $record;
        }
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
            echo $i;
            $res[$i] = $this->caculateCurrentLongestOfNumber($i, $today, $city);
            echo ': ' . $res[$i] . "\r\n";
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
                $count ++;
                return floor($count / 18);
            }
            $count ++;
        }
    }
}
