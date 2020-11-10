<?php

namespace App\Controllers;

use Core\Request;

class ExampleController
{
    public function index(Request $request) {
        $title = 'Example';
        return view('example', compact('title'));
    }
}