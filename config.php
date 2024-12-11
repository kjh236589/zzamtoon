<?php
$kakaoConfig = array(
	'client_id'=>'af89f5fe241d429d5e8d8f6787ca3cfb',

	'client_secret'=>'wtcdHF68M2atxzcNPLB4q6S1QdqIRsPU',

	'login_auth_url'=>'https://kauth.kakao.com/oauth/authorize?response_type=code&client_id={client_id}&redirect_uri={redirect_uri}&state={state}',

	'login_token_url'=>'https://kauth.kakao.com/oauth/token?grant_type=authorization_code&client_id={client_id}&redirect_uri={redirect_uri}&client_secret={client_secret}&code={code}',

	'profile_url'=>'https://kapi.kakao.com/v2/user/me',	

	'redirect_uri'=>'http'.(!empty($_SERVER['HTTPS']) ? 's':null).'://'.$_SERVER['HTTP_HOST'].'/zzamtoon/oauth.php',
);

function curl_kakao($url,$headers = array()){
	if(empty($url)){ return false ; }

	$purl = parse_url($url); $postfields = array();
	if( !empty($purl['query']) && trim($purl['query']) != ''){
		$postfields = explode("&",$purl['query']);
	}

	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POST, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields); 
	if( count($headers) > 0){ 
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
	}

	ob_start(); // prevent any output
	$data = curl_exec($ch); 
	ob_end_clean(); // stop preventing output

	if (curl_error($ch)){ return false;} 

	curl_close($ch); 
	return $data;		
}