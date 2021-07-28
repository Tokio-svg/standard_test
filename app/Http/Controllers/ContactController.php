<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        return view('contact');
        // return view('index', ['items' => $items]);
    }

    public function confirm(Request $request)
    {
        return view('confirm');
    }

    public function thanks(Request $request)
    {
        return view('thanks');
    }

    public function admin(Request $request)
    {
        return view('admin');
    }
}
