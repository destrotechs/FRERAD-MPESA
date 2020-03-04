<?php
class Mpesa{
	public static function mpesaTokenGen(){
		$url='https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
		$consumer_key='5a4ycRIv4GXeI7YAsPgRD9jO6xMn4CvU';
		$secret='AamkaDEWT4Aa62j2';

		$curl=curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		$credentials = base64_encode($consumer_key.':'.$secret);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization:Basic '.$credentials));
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($curl, CURL_SSL_VERIFYPEER, false);

		$curl_response=curl_exec($curl);
		return json_decode($curl_response)->access_token;
	}
}
?>