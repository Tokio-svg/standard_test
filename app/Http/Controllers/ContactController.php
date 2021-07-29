<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    // お問い合わせ
    public function contact(Request $request)
    {
        $inputs = [
            'family_name' => '',
            'first_name' => '',
            'gender' => '',
            'email' => '',
            'postcode' => '',
            'address' => '',
            'building_name' => '',
            'opinion' => ''
        ];
        return view('contact', $inputs);
    }
    // お問い合わせ修正
    public function fix(Request $request)
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
        return view('contact', $inputs);
    }
    // 確認画面
    public function confirm(ContactRequest $request)
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
    // お問い合わせ保存、サンクスページ遷移
    public function create(Request $request)
    {
        $contact = new Contact;
        $fullname = $request->family_name . $request->first_name;
        $contact->fill([
            'fullname' => $fullname,
            'gender' => $request->gender,
            'email' => $request->email,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building_name' => $request->building_name,
            'opinion' => $request->opinion,
        ]);
        // 新規レコードを保存
        $contact->save();
        return view('thanks');
    }
    // 管理システム
    public function admin(Request $request)
    {
        $items = Contact::Paginate(10);
        $inputs = [
            'fullname' => '',
            'gender' => 3,
            'date_start' => '',
            'date_end' => '',
            'email' => '',
        ];
        return view('admin', [
            'items' => $items,
            'inputs' => $inputs
        ]);
    }
    // 管理システム検索結果表示
    public function search(Request $request)
    {
        $items = Contact::where('gender', $request->gender)->get();
        $items->where('id', '>', 5)->get();
        $inputs = [
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'email' => $request->email,
        ];
        return view('admin', [
            'items' => $items,
            'inputs' => $inputs
        ]);
    }
    // 管理システムお問い合わせ削除
    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }
}
