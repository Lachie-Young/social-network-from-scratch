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
			$user = $stmt->execute([
				":first_name" => $firstName,
				":last_name" => $lastName,
				":email" => $email,
				":password" => hash("sha256", $password)
			]);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
		
		return $user;
	}

	public function byEmail($email)
	{
		try {
			$stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
			$stmt->execute([":email" => $email]);
			$user = $stmt->fetch();
		} catch (PDOException $e) {
			die($e->getMessage());
		}
		
		return $user;
	}
	
	public function where($field, $value)
	{
		if ($field !== "password") {
			try {
				$stmt = $this->db->prepare("SELECT * FROM users WHERE $field = :value");
				$stmt->execute([":value" => $value]);
				$user = $stmt->fetch();
			} catch (PDOException $e) {
				die($e->getMessage());
			}

			return $user;
		} else {
			die("Naughty!");
		}
	}
	
}