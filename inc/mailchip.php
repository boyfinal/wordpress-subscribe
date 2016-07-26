<?php

if (!class_exists('FSMC')) {

	class FSMC
	{
		var $version = '3.0';
		var $api_url;
		var $timeout = 300;
		var $api_key;
		var $secure = false;	
		function __construct($api_key, $secure = false)
		{
			$this->api_key = $api_key;
			$this->api_url = parse_url('http://api.mailchimp.com');
			$this->secure = $secure;
		}


		public function list_member_add($data, $list_id){
			$default = array(
				'email_address' => $data['email'],
				'status'        => 'subscribed',
				'merge_fields'  => $data['merge_fields']
			);
			$data = array_merge($default, $data);
			$ch = curl_init(); // initialize cURL connection
			$dc = substr($this->api_key, strpos($this->api_key, '-') + 1);
		 
			curl_setopt($ch, CURLOPT_URL, 'https://' . $dc . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($data['email_address'])));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode('user:' . $this->api_key)));
			curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return the API response
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); // method PUT
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // send data in json
		 
			$result = curl_exec($ch);
			curl_close($ch);
			return $result;
		}
	}
}