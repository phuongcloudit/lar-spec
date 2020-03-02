<?php
namespace App\Payments;

use PEAR;
use HTTP_Request2;
use XML_Unserializer;

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


    public function __construct(Donate $donate){
        $this->base_uri         =   config("payments.epsilon.env") == "production" ? config("payments.epsilon.base_uri") :   config("payments.epsilon.test_uri");
        $this->contract_code    =   config("payments.epsilon.contract_code");
        $this->contract_pass    =   config("payments.epsilon.contract_pass");
        $this->donate = $donate;
    }
    public function createOrder(){
        try{
            $this->donate->eps_payment_code     =   $this->st_code[$this->st];
            $this->donate->eps_mission_code     =   $this->mission_code;
            $this->donate->eps_process_code     =   $this->process_code;
            $this->donate->save();
            $this->donate->refresh();

            $create_order_url   =   $this->base_uri.self::CREATE_ORDER_URL;

            $request = new HTTP_Request2($create_order_url, HTTP_Request2::METHOD_POST, $this->create_order_options);

            $request->addPostParameter('version',       $this->epsilon_vertion );
            $request->addPostParameter('contract_code', $this->contract_code);
            $request->addPostParameter('user_id',       $this->donate->eps_user_id);
            $request->addPostParameter('user_name',     mb_convert_encoding($this->donate->eps_user_name, "UTF-8", "auto"));
            $request->addPostParameter('user_mail_add', $this->donate->eps_email);
            $request->addPostParameter('item_code',     $this->donate->eps_item_code);
            $request->addPostParameter('item_name',     mb_convert_encoding($this->donate->eps_item_name, "UTF-8", "auto"));
            $request->addPostParameter('order_number',  $this->donate->eps_order_number);
            $request->addPostParameter('st_code',       $this->donate->eps_payment_code);
            $request->addPostParameter('mission_code',  $this->donate->eps_mission_code);
            $request->addPostParameter('item_price',    $this->donate->money);
            $request->addPostParameter('process_code',  $this->donate->eps_process_code);
            $request->addPostParameter('memo1',         $this->donate->eps_memo1);
            $request->addPostParameter('memo2',         $this->donate->eps_memo2);
            $request->addPostParameter('xml',           $this->xml_result);
            $request->addPostParameter('character_code',$this->character_code);
            $response = $request->send();

            // Kiểm tra lỗi xử lý
            if (PEAR::isError($response))
                return [
                    "status"        =>  0,
                    "status_code"   =>  "response_error"
                ];

            $res_code = $response->getStatus();

            // Kiểm tra lỗi server epslion
            if($res_code != 200)
                return [
                    "status"        =>  0,
                    "status_code"   =>  "epslion_server_error"
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
                    "status"        =>  0,
                    "status_code"   =>  "xml_parser_error"
                ];

            $res_array = $unserializer->getUnserializedData();

            foreach($res_array['result'] as $uns_k => $uns_v){
                $result_atr_key = key($uns_v);
                $result_atr_val = current($uns_v);

                switch ($result_atr_key) {
                    case 'redirect':
                        $this->donate->eps_redirect = rawurldecode($result_atr_val);
                        break;
                    case 'err_code':
                        $this->donate->is_xml_error = true;
                        $this->donate->xml_error_cd = $result_atr_val;
                        break;
                    case 'err_detail':
                        $this->donate->xml_error_msg = mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
                        break;
                    case 'memo1':
                        $this->donate->xml_memo1_msg = mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
                        break;
                    case 'memo2':
                        $this->donate->xml_memo2_msg = mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
                        break;
                    case 'result':
                        $this->donate->eps_result = mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
                        break;
                        case 'trans_code':
                        $this->donate->trans_code = mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
                        break;
                    default:
                    break;
                }
            }
            $this->donate->save();
            return [
                "status"    =>  1,
                "redirect"  =>  $this->donate->eps_redirect
            ];
        } catch (\Exception $e) {
            return [
                "status"    =>  0,
                "status_code"  =>  "epslion_error"
            ];
        }
        
    }
    public function confirmOrder(Request $request){
        try{
            $confirm_order_url = $this->base_uri.self::CONFIRM_ORDER_URL;
            $request = new HTTP_Request2($confirm_order_url, HTTP_Request2::METHOD_POST);
            $request->setConfig(array(
              'ssl_verify_peer' => false,
            #  'ssl_verify_peer' => true,
                'ssl_cafile' => '/etc/ssl/certs/ca-bundle.crt', //ルートCA証明書ファイルを指定
            ));

            $request->addPostParameter('contract_code', $this->contract_code);
            $request->addPostParameter('trans_code',    $this->donate->trans_code);
            $request->setAuth($this->contract_code, $this->contract_pass,   HTTP_Request2::AUTH_BASIC);
            $response = $request->send();


            if (PEAR::isError($response))
                return [
                    "status"        =>  0,
                    "status_code"   =>  "response_error"
                ];

            $res_code = $response->getStatus();

            // Kiểm tra lỗi server epslion
            if($res_code != 200)
                return [
                    "status"        =>  0,
                    "status_code"   =>  "epslion_server_error"
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
                    "status"        =>  0,
                    "status_code"   =>  "xml_parser_error"
                ];

            $res_array = $unserializer->getUnserializedData(); 
            //error check   
            if(isset($res_array['result']['result']) && $res_array['result']['result'] == "0"){  
                return [
                    "status"        =>  0,
                    "status_code"   =>  "processing_failed"
                ]; 
            }   
        
            $result = array(); 

            //pram setting  
            foreach($res_array['result'] as $uns_k => $uns_v){  

                $result_atr_key = key($uns_v);
                $result_atr_val = current($uns_v);
                $result[$result_atr_key] =  mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
            }
            $this->donate->result = json_encode($result);
            $this->donate->save();

        } catch (\Exception $e) {
            return [
                "status"    =>  0,
                "status_code"  =>  "epslion_error"
            ];
        }

    }
}