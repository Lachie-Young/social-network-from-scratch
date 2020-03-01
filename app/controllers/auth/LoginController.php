<?php

namespace App\Controllers\Auth;

use App\Core\Request;
use App\Models\User;

class LoginController
{
	protected $request;
	protected $user;
	
	public function __construct()
	{
		$this->request = new Request();
		$this->user = new User();
	}
	
    public function index()
	{
		return view("auth/login");
	}
	
	public function login()
	{	
		// Make sure fields are supplied
		$data = $this->request->validate([
			"email" => ["required"],
			"password" => ["required"]
		]);
		
		// Check if user exists and passwords match
		$valid = $this->user->where(["email", "=", $data->email]);
		
		if (!$valid) {
			return redirect("/login?error");
		}
	}
}