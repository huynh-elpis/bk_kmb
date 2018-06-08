<?php

namespace snxs\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use snxs\Http\Requests;
use snxs\Http\Controllers\Controller;

class OnceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        set_time_limit ( 0 );
        $response = ['status' => true];
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach($data as $item){
                $nDate = explode('-', $item['date']);
                $item['date'] = $nDate[2] . '-' . $nDate[1] . '-' . $nDate[0];
				$item['city'] = 72;
				DB::table('xs')->insert($item);
            }
        }
    }

}
