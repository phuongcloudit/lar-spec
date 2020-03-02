<?php

return [

    'epsilon' => [
    	'env'			=>	env('EPS_ENV', 'production'),
    	'base_uri'		=>	"https://beta.epsilon.jp/",//Sau khi sản xuất sẽ được cấp
    	'test_uri'		=>	"https://beta.epsilon.jp/",
        'contract_code' =>	env('EPS_CONTRACT_CODE', 68274950),
        'contract_pass' =>	env('EPS_CONTRACT_PASS', 'DvQdUvfJ')
    ],


];
