<?php

namespace App\Core;

use App\Models\User;

class Validate
{
	protected $user;
	
	public function __construct()
	{
		$this->user = new User();
	}
	
	public function required($field, $value)
	{
		if (empty($value)) {
			$field = str_replace('_', ' ', $field);
			return [
				"status" => false,
				"error" => ucfirst("{$field} is required")
			];
		}
		
		return true;
	}
	
	public function unique($field, $value)
	{
		$userExists = $this->user->where($field, $value);

		if ($userExists) {
			return [
				"status" => false,
				"error" => ucfirst("{$value} is unavailable")
			];
		}
		
		return true;
	}
	
	public function email($field, $value)
	{
		$isValidEmail = filter_var($value, FILTER_VALIDATE_EMAIL);
		
		if (!$isValidEmail) {
			return [
				"status" => false,
				"error" => ucfirst("Please enter a valid email address")
			]; 
		}
		
		return true;
	}
}