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
	
	public function where(array $conditions)
	{	
	
		$query = "";
		$values = [];
		// Check whether the first element in the array is another array
		// Meaning we will query multiple fields
		// TODO: This seems hacky? Find better way to check?
		
		if (is_array($conditions[0])) {
			$i = 0;
			// Loop over each condition
			foreach ($conditions as $condition) {
				$field = $condition[0];
				$comparitor = $condition[1];
				$value = $condition[2];
				
				$values[":$field"] = $value;
				
				// Check if last item in array
				if ($i == count($conditions) - 1) {
					$query .= "$field $comparitor :$field";
				} else {
					$query .= "$field $comparitor :$field AND ";
				}
				
				$i++;
			}
		} else {
			// Else condition is only singular
			$field = $conditions[0];
			$comparitor = $conditions[1];
			$value = $conditions[2];
			
			$values[":$field"] = $value;
			
			$query .= "$field $comparitor :$field";
		}
		
		$sql = "SELECT * FROM users WHERE $query";
				
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute($values);
			$user = $stmt->fetch();
		} catch (PDOException $e) {
			die($e->getMessage());
		}

		return $user;
	}
}





