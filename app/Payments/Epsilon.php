<?php
namespace App\Payments;

use PEAR;
use HTTP_Request2;
use XML_Unserializer;

use Request;
use App\Models\Donate;

class Epsilon
{

    const CREATE_ORDER_URL          =   "/cgi-bin/order/receive_order3.cgi";
    const CONFIRM_ORDER_URL         =   "/cgi-bin/order/getsales2.cgi";

    protected $donate;
    protected $epsilon_vertion  =   2;
    protected $contract_code;
    protected $contract_pass;   
    protected $create_order_options = array(
            "timeout" => "20", // Chỉ định số giây cho thời gian chờ
            //    "allowRedirects" => true, // Cài đặt quyền chuyển hướng (true/false)
            //    "maxRedirects" => 3, // Số lượng chuyển hướng tối đaリダイレクトの最大回数
    );
    protected $st_code = array( 
        'normal'  => '10100-0000-00000-00010-00000-00000-00000',
        'card'    => '10000-0000-00000-00000-00000-00000-00000',
        'conveni' => '00100-0000-00000-00000-00000-00000-00000',
        'atobarai'=> '00000-0000-00000-00010-00000-00000-00000',
    );
    protected $st   =   "card";
    protected $mission_code     =   1;
    protected $process_code     =   1;
    protected $xml_result       =   1;
    protected $character_code   =   "UTF8";

    protected $payment_name = array(
        1 => "VISA/MASTER/DINERS",
        2 => "JCB/AMEX",
        3 => "コンビニエンスストア",
        4 => "ジャパンネット銀行",
        5 => "楽天銀行",
        6 => "カンガルー代引",
        7 => "ペイジー",
        8 => "ウェブマネー",
        9 => "Yahoo!ウォレット",
        11 => "PayPal",
        12 => "BitCash",
        13 => "電子マネーちょコム",
        14 => "ゆうパックコレクト",
        15 => "スマートフォンキャリア決済",
        16 => "JCB　PREMO",
        17 => "SBIネット銀行",
        18 => "GMO後払い",
        19 => "多通貨クレジットカード決済",
    );
    public function __construct(){
        $this->base_uri         =   config("payments.epsilon.env") == "production" ? config("payments.epsilon.base_uri") :   config("payments.epsilon.test_uri");
        $this->contract_code    =   config("payments.epsilon.contract_code");
        $this->contract_pass    =   config("payments.epsilon.contract_pass");
        // /$this->donate = $donate;
    }
    public function createOrder($data){
        try{
            $data["version"]        =   $this->epsilon_vertion;
            $data["contract_code"]  =   $this->contract_code;
            $data["st_code"]        =   $this->st_code[$this->st];
            $data["mission_code"]   =   $this->mission_code;
            $data["process_code"]   =   $this->process_code;
            $data["xml_result"]     =   $this->xml_result;
            $data["character_code"] =   $this->character_code;
            
            $create_order_url   =   $this->base_uri.self::CREATE_ORDER_URL;
            $request = new HTTP_Request2($create_order_url, HTTP_Request2::METHOD_POST, $this->create_order_options);

            foreach ($data as $key => $value) {
                $request->addPostParameter($key,  $value);
            }

            $response = $request->send();

            // Kiểm tra lỗi xử lý
            if (PEAR::isError($response))
                return [
                    "result"        =>  0,
                    "err_detail"   =>  "支払情報の取得に失敗しました"
                ];

            $res_code = $response->getStatus();

            // Kiểm tra lỗi server epslion
            if($res_code != 200)
                return [
                    "result"        =>  0,
                    "err_detail"   =>  "支払情報の取得に失敗しました"
                ];

            // Xử lý kết quả trả về

            $res_content = $response->getBody();
            $temp_xml_res = str_replace("x-sjis-cp932", "UTF-8", $res_content);
            $unserializer = new XML_Unserializer();
            $unserializer->setOption('parseAttributes', TRUE);
            $unseriliz_st = $unserializer->unserialize($temp_xml_res);

            // Kiểm tra định dạng trả về
            if ($unseriliz_st !== true)
                return [
                    "result"        =>  0,
                    "err_detail"   =>  "支払情報の取得に失敗しました"
                ];

            $res_array = $unserializer->getUnserializedData();
            $result = array();
            foreach($res_array['result'] as $uns_k => $uns_v){
                $result_atr_key = key($uns_v);
                $result_atr_val = current($uns_v);

                switch ($result_atr_key) {
                    case 'redirect':
                        $result['redirect']     =   rawurldecode($result_atr_val);
                        break;
                    case 'err_code':
                        $result['err_code']     =   $result_atr_val;
                        break;
                    case 'err_detail':
                        $result['err_detail']   =    mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
                        break;
                    case 'memo1':
                        $result['memo1']        =    mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
                        break;
                    case 'memo2':
                        $result['memo2']        =   mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
                        break;
                    case 'result':
                        $result['result']       =    mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
                        break;
                    case 'trans_code':
                        $result['trans_code']   =   mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
                        break;
                    default:
                    break;
                }
            }
            return $result;
        } catch (\Exception $e) {
            return [
                "result"    =>  0,
                "err_detail"  =>  "支払情報の取得に失敗しました"
            ];
        }
        
    }
    public function confirmOrder(){
        $data = Request::all();
       
        $confirm_order_url = $this->base_uri.self::CONFIRM_ORDER_URL;
        $request = new HTTP_Request2($confirm_order_url, HTTP_Request2::METHOD_POST);
        $request->setConfig(array(
          'ssl_verify_peer' => false,
        #  'ssl_verify_peer' => true,
            'ssl_cafile' => '/etc/ssl/certs/ca-bundle.crt', //ルートCA証明書ファイルを指定
        ));

        $request->addPostParameter('contract_code', $this->contract_code);
        $request->addPostParameter('trans_code',    $data['trans_code']);
        $request->setAuth($this->contract_code, $this->contract_pass,   HTTP_Request2::AUTH_BASIC);
        $response = $request->send();


        if (PEAR::isError($response))
            return [
                "result"        =>  0,
                "err_detail"   =>  "response_error"
            ];

        $res_code = $response->getStatus();

        // Kiểm tra lỗi server epslion
        if($res_code != 200)
            return [
                "result"        =>  0,
                "err_detail"   =>  "支払情報の取得に失敗しました"
            ];

        // Xử lý kết quả trả về

        $res_content = $response->getBody();
        $temp_xml_res = str_replace("x-sjis-cp932", "UTF-8", $res_content);
        $unserializer = new XML_Unserializer();
        $unserializer->setOption('parseAttributes', TRUE);
        $unseriliz_st = $unserializer->unserialize($temp_xml_res);

        // Kiểm tra định dạng trả về
        if ($unseriliz_st !== true)
            return [
                "result"        =>  0,
                "err_detail"   =>  "支払情報の取得に失敗しました"
            ];

        $res_array = $unserializer->getUnserializedData(); 

        //error check   
        if(isset($res_array['result']['result']) && $res_array['result']['result'] == "0"){  
            return [
                "result"        =>  0,
                "err_detail"   =>  "処理に失敗しました"
            ]; 
        }   
        
        $result = array(); 

        //pram setting  
        foreach($res_array['result'] as $uns_k => $uns_v){ 
            $result_atr_key = key($uns_v);
            $result_atr_val = current($uns_v);
            $result[$result_atr_key] =  mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
        }

        $check_exists = Donate::whereTransCode($result["trans_code"])->whereUserId($result["user_id"])->first();
        
        if($check_exists){
            return [
                "result"        =>  1,
                "trans_code"    =>  $check_exists->trans_code,
                "user_id"       =>  $check_exists->user_id,
            ];
        }

        $data = [
            "project_id"       =>   $result["memo1"],
            "trans_code"       =>   $result["trans_code"],
            "user_id"          =>   $result["user_id"],
            "state"            =>   $result["state"],
            "money"            =>   $result["item_price"],
            "payment_name"     =>   $this->get_payment_name($result["payment_code"]),
            "credit_time"      =>   $result["credit_time"],
            "last_update"      =>   $result["last_update"],
            "user_mail_add"    =>   $result["user_mail_add"],
            "user_name"        =>   $result["user_name"],
            "item_code"        =>   $result["item_code"],
            "item_name"        =>   $result["item_name"],
            "order_number"     =>   $result["order_number"],
            "st_code"          =>   $result["st_code"],
            "pay_time"         =>   $result["pay_time"],
            "epsilon_info"     =>   json_encode($result)
        ];
        $donate     =   Donate::create($data);
        return [
            "result"        =>  1,
            "trans_code"    =>  $donate->trans_code,
            "user_id"       =>  $donate->user_id,
        ];
    }
    protected function get_payment_name($payment_code){
        return isset($this->payment_name[$payment_code])?$this->payment_name[$payment_code]:"N/A";
    }
}