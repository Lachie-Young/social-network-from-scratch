<?php

namespace App\Core;

class Session
{
	public function __construct()
	{
		if (!isset($_SESSION)) {
			session_start();
		}
	}
	
	public function set($key, $value)
	{
		if (!array_key_exists($key, $_SESSION)) {
			$_SESSION[$key] = $value;
			
			return $_SESSION;
		}
	}
	
	public function get($key)
	{
		if (array_key_exists($key, $_SESSION)) {
			return $_SESSION[$key];
		}
	}
	
	public function remove($key)
	{
		if (array_key_exists($key, $_SESSION)) {
			unset($_SESSION[$key]);
			
			return $_SESSION;
		}
	}
	
	public function has($key)
	{
		return array_key_exists($key, $_SESSION);
	}
	
	public function flash($key, $value)
	{
		$_SESSION[$key] = $value;
	}
		
	public function errors($key = null)
	{
		if ($_SESSION) {
			if ($key) {
				if (array_key_exists($key, $_SESSION["errors"])) {
					return $_SESSION["errors"][$key];
				}
			} else {
				return $_SESSION["errors"];
			}
		}
	}
}