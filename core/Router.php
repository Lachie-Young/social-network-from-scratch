<?php

namespace App\Core;

use App\Core\Request;
use App\Core\Session;

class Router
{	
    private $routes = [
        "GET" => [],
        "POST" => []
    ];
	
	protected $session;
	
	public function __construct()
	{
		$this->session = new Session();
	}

    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    public function get(string $uri, $action, $auth = null): void
    {
        $this->routes["GET"][trim($uri, "/")] = [
			"action" => $action,
			"auth" => $auth
		];
    }

    public function post(string $uri, $action, $auth = null): void
    {
        $this->routes["POST"][trim($uri, "/")] = [
			"action" => $action,
			"auth" => $auth
		];
    }

    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
			
			$routeRequiresAuth = isset($this->routes[$requestType][$uri]["auth"]);
						
			if ($routeRequiresAuth) {
				$this->authenticate();
			}
			
			// Route requires no auth, proceed.
            return $this->execute(
                ...explode("@", $this->routes[$requestType][$uri]["action"])
            );
        }

        throw new \Exception("No route defined for this URI: {$uri}");
    }

    private function execute($controller, $action)
    {
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller;

        if (! method_exists($controller, $action)) {
            throw new \Exception(
                get_class($controller) ." does not respond to the {$action} action."
            );
        }

        return $controller->$action();
    }
	
	private function authenticate()
	{
		$authenticated = $this->session->has("auth");
		
		if (!$authenticated) {
			return redirect("/login");
		}
	}
}