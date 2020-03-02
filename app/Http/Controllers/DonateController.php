<?php

namespace App\Http\Controllers;

use App\Models\Donate;
use Illuminate\Http\Request;
use App\Payments\Epsilon;
use App\Http\Requests\DonateRequest;

class DonateController extends Controller
{
    protected $default_name     =   "Default";
    protected $default_email    =   "default@demo.com";
    public function store(DonateRequest $request, $id){
        $data   =   [
            "post_id"       =>  $id,
            "money"         =>  $request->money,
            "eps_user_name" =>  $request->name?:$this->default_name,
            "eps_email"     =>  $request->email?:$this->default_email
        ];
        $donate     =   Donate::create($data);
        $epsilon    =   new Epsilon($donate);
        $result     =   $epsilon->createOrder();
        if($result["status"] === 1)
            return redirect($result["redirect"]);

        exit($result["status_code"]);
    }

    public function confirm(Request $request){
        if($request->result != 1)
            exit("ERROR");

        $donate = Donate::where("eps_order_number",$request->order_number)->where("eps_user_id",$request->user_id)->first();
        
        if(is_null($donate))
            abort(404);

        //update trans_code
        $donate->trans_code = $request->trans_code;
        $donate->save();
        $donate->refresh();

        $epsilon    =   new Epsilon($donate);
        $result     =   $epsilon->confirmOrder();

        if($result["status"] === 1)
            return redirect($result["redirect"]);

        exit($result["status_code"]);
        
    }
}
