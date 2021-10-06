<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index() {
        $data = ['msg' => 'メッセージ'];
        return view('hello.index', $data);
    }
}
