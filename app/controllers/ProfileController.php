<?php

namespace App\Controllers;

class ProfileController
{
    public function index()
    {
        return view("home", [
            "name" => "John Doe"
        ]);
    }
}