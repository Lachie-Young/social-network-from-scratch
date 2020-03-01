<?php

namespace App\Controllers\Auth;

use App\Core\Request;
use App\Models\User;
Use App\Core\Session;

class LoginController
{
	protected $request;
	protected $user;
	protected $session;
	
	public function __construct()
	{
		$this->request = new Request();
		$this->user = new User();
		$this->session = new Session();
	}
	
    public function index()
	{
		return view("auth/login");
	}
	
	public function login()
	{	
		// Make sure fields are supplied
		$data = $this->request->validate([
			"email" => ["required", "email"],
			"password" => ["required"]
		]);
		
		// Check if user exists and passwords match
		$user = $this->user->where(["email", "=", strtolower($data->email)]);
		
		// If no user is found, redirect back
		if (!$user) {
			// TODO: Handle flash to session
			return redirect("/login?error");
		}
		
		// A user was found, compare passwords
		$valid = hash("sha256", $data->password) === $user["password"];
		
		// If password is wrong redirect user back
		if (!$valid) {
			// TODO: Handle flash to session
			return redirect("/login?error");
		}
		
		// User is valid, create session
		$this->session->set("auth", [
			"id" => $user["id"]
		]);
		
		return redirect("/");
	}
}