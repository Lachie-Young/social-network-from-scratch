<?php

namespace App\Controllers\Auth;

use App\Core\Request;
use App\Models\User;

class RegisterController
{
	protected $request;
	
	public function __construct()
	{
		$this->request = new Request();
	}
	
    public function index()
	{
		return view("auth/register");
	}
	
	public function register()
	{	
		$data = $this->request->validate([
			"first_name" => ["required"],
			"last_name" => ["required"],
			"email" => ["required", "email", "unique"],
			"password" => ["required"]
		]);
		
		$user = new User();
		
		$user->create(
			$data->first_name,
			$data->last_name,
			strtolower($data->email),
			$data->password
		);

		return redirect("/login?success");
	}
}