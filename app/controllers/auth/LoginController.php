<?php

namespace App\Controllers\Auth;

use App\Core\Request;

class LoginController
{
	protected $request;
	
	public function __construct()
	{
		$this->request = new Request();
	}
	
    public function index()
	{
		return view("auth/login");
	}
	
	public function login()
	{	
		$data = $this->request->validate([
			"email" => ["required"],
			"password" => ["required"]
		]);
	}
}