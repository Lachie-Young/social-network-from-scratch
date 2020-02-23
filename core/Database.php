<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    public static function connect($config)
	{
		try {
			return new PDO(
				$config['connection'].';dbname='.$config['name'],
				$config['username'],
				$config['password'],
				$config['options']
			);
		} catch (PDOException $e) {
			die($e->getMessage());
		}	
	}
}