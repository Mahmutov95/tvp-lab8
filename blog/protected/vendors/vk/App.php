<?php

function mpr($data)
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

class App
{
	const API_VERSION = '5.28';
	const TOKEN = '66af71bc563d585bfd9920583c359aca1de12604670cbd9c4a5be4610886896852b97a8c43d490f55d5ef';
	const METHOD_URL = 'https://api.vk.com/method/';
	
	public function api($method = '', $vars = array())
	{
		// Передача версии используемого VK.API
		$vars['v'] = self::API_VERSION; 
		// Склеивание параметров в url строку
		$params = http_build_query($vars);
		
		$url = self::http_build_query($method, $params);
		return (array)self::call($url);
	}
	
	private static function http_build_query($method, $params = '')
	{
		return self::METHOD_URL.$method.'?'.$params.'&access_token='.self::TOKEN;
	}
	
	private static function call($url = '')
	{
		if(function_exists('curl_init'))
			$json = self::curl_post($url);
		else
			$json = file_get_contents($url);
		$json = json_decode($json, true);
		if(isset($json['response']))
			return $json['response'];
		return $json;
	}

	private static function curl_post($url)
	{
		if(!function_exists('curl_init'))
			return false;
		$param = parse_url($url);
		if( $curl = curl_init() )
		{
			curl_setopt($curl, CURLOPT_URL, $param['scheme'].'://'.$param['host'].$param['path']);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $param['query']);
			$out = curl_exec($curl);
			curl_close($curl);
			return $out;
		}
		return false;
	}
}