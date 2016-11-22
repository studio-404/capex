<?php 
namespace functions; 

class string
{
	public function cut($text,$number)
	{
		$charset = 'UTF-8';
		$length = $number;
		$string = $text;
		if(mb_strlen($string, $charset) > $length) {
			$string = mb_substr($string, 0, $length, $charset) . '...';
		}
		else
		{
			$string=$text;
		}
		return $string; 
	}

	public static function random($length)
	{
		$bytes = openssl_random_pseudo_bytes($length * 2);
		return substr(str_replace(array('/', '+', '='), '', base64_encode($bytes)), 0, $length);
	}
}