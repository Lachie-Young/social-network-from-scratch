<?php

use App\Core\Session;

function dd($data)
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

function view($view, $data = [])
{
    extract($data);
	
    require "resources/views/{$view}.view.php";
	
	// Unset flashed messages
	if (isset($_SESSION['errors'])) {
		unset($_SESSION['errors']);	
	}
	return;
}

function redirect($uri)
{
	return header("Location: {$uri}");
}

function back()
{
	redirect($_SERVER["REQUEST_URI"]);
}

function partial($name)
{
	return require "resources/views/partials/{$name}.php";
}

function isAuth()
{
	// TODO: Implement auth
	return false;
}

// TODO: Change this so it returns a singlton instance of the session from DI container
function session()
{
	return new Session();
}