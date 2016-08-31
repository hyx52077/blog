<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class jsonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();

        $input['order_by'] = 'level';
        $json = $this->GoCurl('http://v1.mob.api.duobao369.com/prize/prize_list','GET',$input);
        $array = json_decode($json, true);

        return response()->json($array);
    }

    public function duobao369(Request $request)
    {
        $input = $request->all();

        $input['order_by'] = 'level';

        $json = $this->GoCurl('http://v1.mob.api.duobao369.com/prize/prize_list','GET',$input);
        $array = json_decode($json, true);

        foreach($array['data'] as $key => $val){

            if(DB::table('goods_jilu')->where('goods_id',$val['goods_id'])->count()){
                $array['data'][$key]['isget'] = true;
            }
        }

        return response()->json($array);
    }

    public function get_duobaogoods_row(Request $request){


        $getid = $request->input('getid');
        $id = $request->input('add');
        $goods = null;
        if($getid){
            $goods = DB::table('goods_jilu')->where('goods_id',$getid)->first();
            if(!$goods){$goods['res'] = 404;}
            return response()->json($goods);
        }

        if($id && !$goods){
            $tid = DB::table('goods_jilu')->insertGetId([
                'goods_id' => $id
            ]);
            return response()->json(array(['id' => $tid,'goods_id'=>$id]));
        }

        return response()->json(array(['res' => 404]));
    }
    public  function  api_1yyg(Request $request){
        $page = $request->input('Page') > 0? '/'.$request->input('Page') : '';

        $json = $this->GoCurl('http://m.yungou163.com/index.php/mobile/mobile/glistajax/list/10'.$page,'GET');
        $array = json_decode($json, true);
        return response()->json($array);
    }

}
