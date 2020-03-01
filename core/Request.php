<?php

namespace App\Core;

use App\Core\Session;
use App\Core\Validate;

class Request
{
	protected $session;
	protected $validate;
	
	public function __construct()
	{
		$this->session = new Session();
		$this->validate = new Validate();
	}
		
    public static function uri(): string
    {
        return trim(
            parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/"
        );
    }

    public static function method(): string
    {
        return $_SERVER["REQUEST_METHOD"];
    }
	
	public function data($key = "")
	{
		if (!empty($key)) {
			if (array_key_exists($key, $_REQUEST)) {
				return $_REQUEST[$key];
			} else {
				return "";
			}
		}
		
		return $_REQUEST;
	}
	
	public function validate(array $data)
	{
		$errors = [];
		
		foreach ($data as $field => $rules) {			
			foreach ($rules as $rule) {
				
				// Run each validation rule for each input field
				$enteredValue = $this->data($field);
				$validatedField = $this->validate->$rule($field, $enteredValue);
				
				// If field does not pass validation, push error messages into message bag to be flashed to session
				if (is_array($validatedField)) {
					if (array_key_exists("status", $validatedField) && $validatedField["status"] == false) {
						$errors[$field][] = $validatedField["error"];
					}
				}
			}
		}
		
		// Flash the error messages to the session
		if (!empty($errors)) {
			$this->session->flash("errors", $errors);
			return back();
		}
		
		// Data is validated
		$data = new self();
		foreach ($this->data() as $field => $value) {
			$data->$field = $value;
		}
		
		return $data;
	}
}