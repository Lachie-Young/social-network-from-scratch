<?php

namespace App\Core;

class Validate
{
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
}