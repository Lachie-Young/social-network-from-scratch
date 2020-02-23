<?php

namespace App\Models;

use App\Core\App;

class Model
{
	protected $db;
	
	public function __construct()
	{
		$this->db = App::get("database");
	}
}