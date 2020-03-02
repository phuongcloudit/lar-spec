<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
	<title></title>
</head>
<body>

<?php 
use HTTP_Request2\HTTP\Request2;
use XML_Serializer\XML\Unserializer;
//require_once $path = base_path('vendor/pear/http_request2/HTTP/Request2.php');
//require_once $path = base_path('vendor/pear/xml_serializer/XML/Unserializer.php');
mb_language("Japanese");
mb_internal_encoding("UTF-8");
	$order_url = "https://beta.epsilon.jp/cgi-bin/order/receive_order3.cgi";
	$option = array(
    	"timeout" => "20", // Chỉ định số giây cho thời gian chờ
  		//    "allowRedirects" => true, // Cài đặt quyền chuyển hướng (true/false)
  		//    "maxRedirects" => 3, // Số lượng chuyển hướng tối đaリダイレクトの最大回数
	);

 	$request = new HTTP_Request2($order_url, HTTP_Request2::METHOD_POST, $option);
	$request->setConfig(array(
	     'ssl_verify_peer' => false,
	#     'ssl_verify_peer' => true,
	#     'ssl_cafile' => '/etc/ssl/certs/ca-bundle.crt', //ルートCA証明書ファイルを指定
	));  

	$st_code = array( 
		'normal'  => '10100-0000-00000-00010-00000-00000-00000',
        'card'    => '10000-0000-00000-00000-00000-00000-00000',
        'conveni' => '00100-0000-00000-00000-00000-00000-00000',
        'atobarai'=> '00000-0000-00000-00010-00000-00000-00000',
	);
	$mission_item = array(
	    1 => '1回課金',
	    21 => '定期課金1',
	    22 => '定期課金2',
	    23 => '定期課金3',
	    24 => '定期課金4',
	    25 => '定期課金5',
	    26 => '定期課金6',
	    27 => '定期課金7',
	    28 => '定期課金8',
	    29 => '定期課金9',
	    30 => '定期課金10',
	    31 => '定期課金11',
	    32 => '定期課金12',
	);
	$contract_code	=	68274950;
	$user_id 		=	rand(0,99999999);
	$user_name		=	"TEST 1";
	$user_mail_add	=	"hoangphu.nam0604@gmail.com";
	$item_code		=	"GD00001";
	$item_name		=	"Product Name 1";
	$order_number 	= 	rand(0,99999999);
	$st				=	"conveni";
	$mission_code	=	1;
	$item_price		=	100;
	$process_code	=	1;
	$memo1			=	"Memo Test Product Name 1";
	$memo2			=	"Memo Test Product Name 2";

	$request->addPostParameter('version', '2' );
	$request->addPostParameter('contract_code', $contract_code);
	$request->addPostParameter('user_id', $user_id);
	$request->addPostParameter('user_name', mb_convert_encoding($user_name, "UTF-8", "auto"));
	$request->addPostParameter('user_mail_add', $user_mail_add);
	$request->addPostParameter('item_code', $item_code);
	$request->addPostParameter('item_name', mb_convert_encoding($item_name, "UTF-8", "auto"));
	$request->addPostParameter('order_number', $order_number);
	$request->addPostParameter('st_code', $st_code[$st]);
	$request->addPostParameter('mission_code', $mission_code);
	$request->addPostParameter('item_price', $item_price);
	$request->addPostParameter('process_code', $process_code);
	$request->addPostParameter('memo1', $memo1);
	$request->addPostParameter('memo2', $memo2);
	$request->addPostParameter('xml', '1');
	$request->addPostParameter('character_code', 'UTF8' );

	// Kết quả nhận được
	$response = $request->send();
	if (!PEAR::isError($response)):
		$res_code = $response->getStatus();
		$res_content = $response->getBody();

		//xml unserializer
	    $temp_xml_res = str_replace("x-sjis-cp932", "UTF-8", $res_content);
	    $unserializer = new XML_Unserializer();
	    $unserializer->setOption('parseAttributes', TRUE);
	    $unseriliz_st = $unserializer->unserialize($temp_xml_res);
	    if ($unseriliz_st === true) {
	        //xmlを解析
	        $res_array = $unserializer->getUnserializedData();
	        $is_xml_error = false;
	        $xml_redirect_url = "";
	        $xml_error_cd = "";
	        $xml_error_msg = "";
	        $xml_memo1_msg = "";
	        $xml_memo2_msg = "";
	        $result = "";
	        $trans_code = "";
	        var_dump($res_array['result']);
	        exit();
	        foreach($res_array['result'] as $uns_k => $uns_v){

	        	$result_atr_key = key($uns_v);
				$result_atr_val = current($uns_v);

				var_dump($result_atr_key);

	            switch ($result_atr_key) {
	              case 'redirect':
	                $xml_redirect_url = rawurldecode($result_atr_val);
	                echo "<br />xml_redirect_url	:	". $xml_redirect_url;
	                header('Location: '.$xml_redirect_url);
	                exit();
	                break;
	              case 'err_code':
	                $is_xml_error = true;
	                $xml_error_cd = $result_atr_val;
	                echo "<br />xml_error_cd	:	". $xml_error_cd;
	                break;
	              case 'err_detail':
	                $xml_error_msg = mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
	                echo "<br />xml_error_msg	:	". $xml_error_msg;
	                break;
	              case 'memo1':
	                $xml_memo1_msg = mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
	                echo "<br />xml_memo1_msg	:	". $xml_memo1_msg;
	                break;
	              case 'memo2':
	                $xml_memo2_msg = mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
	                echo "<br />result	:	". $xml_memo2_msg;
	                break;
	              case 'result':
	                $result = mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
	                echo "<br />result	:	". $result;
	                break;
	              case 'trans_code':
	                $trans_code = mb_convert_encoding(urldecode($result_atr_val), "UTF-8" ,"auto");
	                echo "<br />trans_code	:	".$trans_code;
	                break;
	              default:
	                break;
	            }
	        }

	    }else{
	        //xml parser error
	        $err_msg = "xml parser error<br><br>";
	        echo $err_msg;
	        
	    }
	else:
		exit("PEAR ERROR!");
	endif;
	?>

</body>
</html>