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
            'gender' => 1,
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
        // 入力情報を格納
        $inputs = [
            'fullname' => $request->input('fullname'),
            'gender' => $request->input('gender'),
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
            'email' => $request->input('email'),
        ];

        // 各項目検索
        $query = Contact::query();

        if (!empty($inputs['fullname'])) {
            $query->where('fullname', 'LIKE', "%{$inputs['fullname']}%");
        }

        if (!empty($inputs['gender']) | $inputs['gender'] == 3) {
            if ($inputs['gender'] == 3) {
                $query->where('gender', '>', 0);
            } else {
                $query->where('gender', $inputs['gender']);
            }
        }

        if (!empty($inputs['date_start'])) {
            $query->where('created_at', '>=', $inputs['date_start']);
        }

        if (!empty($inputs['date_end'])) {
            $query->where('created_at', '<=', $inputs['date_end']);
        }

        if (!empty($inputs['email'])) {
            $query->where('email', 'LIKE', "%{$inputs['email']}%");
        }

        $items = $query->paginate(10);

        return view('admin', [
            'items' => $items,
            'inputs' => $inputs
        ]);
    }

    // 管理システムお問い合わせ削除
    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        $url = $request->input('url');
        return redirect($url);
    }

    // test用（後で消すこと）
    public function confirmcheck(Request $request)
    {
        $inputs = [
            'family_name' => '田所',
            'first_name' => '浩司',
            'gender' => 2,
            'email' => 'test@mail.com',
            'postcode' => '114-0514',
            'address' => '下北沢',
            'building_name' => '野獣邸',
            'opinion' => 'まずうちさあ…屋上…あんだけど……焼いてかない？'
        ];
        return view('confirm', $inputs);
    }
    public function thanks(Request $request)
    {
        return view('thanks');
    }
}
