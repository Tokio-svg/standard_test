<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        return view('contact');
        // return view('index', ['items' => $items]);
    }

    public function confirm(Request $request)
    {
        $inputs = [
            'family_name' => $request->family_name,
            'first_name' => $request->first_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building_name' => $request->building_name,
            'opinion' => $request->opinion
        ];
        return view('confirm', $inputs);
    }

    public function thanks(Request $request)
    {
        return view('thanks');
    }

    public function admin(Request $request)
    {
        $items = Contact::Paginate(10);
        // $inputs = [
        //     'fullname' => '',
        //     'gender' => 3,
        //     'date_start' => '',
        //     'date_end' => '',
        // ];
        return view('admin', [
            'items' => $items,
            // 'inputs' => $inputs
        ]);
    }

    public function search(Request $request)
    {
        $items = Contact::where('gender', $request->gender)->Paginate(10);
        // $inputs = [
        //     'fullname' => $request->fullname,
        //     'gender' => $request->gender,
        //     'date_start' => $request->date_start,
        //     'date_end' => $request->date_end,
        // ];
        return view('admin', [
            'items' => $items,
            // 'inputs' => $inputs
        ]);
    }
}
