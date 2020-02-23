<?php

namespace App\Models;

use App\Models\Model;

class User extends Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function create($firstName, $lastName, $email, $password)
	{
		$sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)";
		
		$stmt = $this->db->prepare($sql);
		try {
			$stmt->execute([
			"first_name" => $firstName,
			"last_name" => $lastName,
			"email" => $email,
			"password" => $password
			]);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	
}