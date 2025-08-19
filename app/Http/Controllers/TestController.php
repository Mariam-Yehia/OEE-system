<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function firstAction(){
        $localName = 'Mariam';
        $books = ['html', 'js', 'css'];
        return view('test', ['name' => $localName, 'books' => $books]);

    }
}
