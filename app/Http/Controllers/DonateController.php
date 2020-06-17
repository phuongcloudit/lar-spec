<?php

namespace App\Http\Controllers;
use App\Http\Requests\DonateRequest;

use App\Models\Project;
use App\Models\Donate;
use Illuminate\Http\Request;
use App\Payments\Epsilon;


class DonateController extends Controller
{
    protected $default_name     =   "Default";
    protected $default_email    =   "default@demo.com";
    protected $item_prefix  =   "SPEC";
    public function store(DonateRequest $request, $id){
        $project = Project::findOrFail($id);
        $data   =   [
            'user_id'       =>  rand(0,99999999),
            'user_name'     =>  $request->name?:$this->default_name,
            'user_mail_add' =>  $request->email?:$this->default_email,
            'item_code'     =>  $this->item_prefix.$project->id,
            'item_name'     =>  $project->name,
            'order_number'  =>  time(),
            'item_price'    =>  $request->money,
            'memo1'         =>  $project->id,
            'memo2'         =>  ""
        ];

        $epsilon    =   new Epsilon();
        $result     =   $epsilon->createOrder($data);
        if($result):
            if(isset($result["result"]) && $result["result"] == 1 && isset($result["redirect"]) && $result["redirect"]):
                return redirect($result["redirect"]);
            endif;
            $error = isset($result["err_detail"])?$result["err_detail"]:"Lỗi không xác định!";
            return redirect()->back()->withErrors($error);
        endif;
        abort(403);
    }

    public function confirm(Request $request){
        
        $epsilon    =   new Epsilon();
        $result     =   $epsilon->confirmOrder();
        if($result["result"] == 0)
            return redirect()->route("donate.error")->withErrors($result["err_detail"]);

        return redirect()->route("donate.thanks",["trans_code"  =>  $result["trans_code"],"user_id" =>  $result["user_id"]]);
    }
    public function cancel(Request $request){        
        return view("donates.cancel");
        
    }
    public function error(Request $request){        
        return view("donates.error");
        
    }
    public function thanks($trans_code,$user_id){  
        $donate     =   Donate::whereTransCode($trans_code)->whereUserId($user_id)->first();
        return view("donates.thanks",compact('donate'));
        
    }
    
}
