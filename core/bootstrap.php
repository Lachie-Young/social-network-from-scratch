<?php

use App\Core\App;
use App\Core\Database;

App::bind("config", require "config.php");

App::bind("database", Database::connect(App::get("config")["database"]));