<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問い合わせ</title>
  <!-- スタイルシート読み込み -->
  @if(app('env')=='local')
  <link rel="stylesheet" href="{{asset('/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('/css/contact_style.css')}}">
  @else
  <link rel="stylesheet" href="{{secure_asset('/css/reset.css')}}">
  <link rel="stylesheet" href="{{secure_asset('/css/contact_style.css')}}">
  @endif
</head>

<body>
  <main>
    <h1>お問い合わせ</h1>
    <form action="/confirm" method="post" class="form__create">
      @csrf
      <table>
        <tr>
          <th>お名前<span class="red">※</span></th>
          <td>
            <input type="text" name="family_name">
            <p>例）山田</p>
            <input type="text" name="first_name">
            <p>例）太郎</p>
          </td>
        </tr>
        <tr>
          <th>性別<span class="red">※</span></th>
          <td>
            <input type="radio" name="gender" value="1" checked>男性
            <input type="radio" name="gender" value="2">女性
          </td>
        </tr>
        <tr>
          <th>メールアドレス<span class="red">※</span></th>
          <td>
            <input type="email" name="email">
            <p>例）test@example.com</p>
          </td>
        </tr>
        <tr>
          <th>郵便番号<span class="red">※</span></th>
          <td>
            <p>〒</p>
            <input type="text" name="postcode">
            <p>例）123-4567</p>
          </td>
        </tr>
        <tr>
          <th>住所<span class="red">※</span></th>
          <td>
            <input type="text" name="address">
            <p>例）東京都渋谷区千駄ヶ谷1-2-3</p>
          </td>
        </tr>
        <tr>
          <th>建物名</th>
          <td>
            <input type="text" name="building_name">
            <p>例）千駄ヶ谷マンション101</p>
          </td>
        </tr>
        <tr>
          <th>ご意見<span class="red">※</span></th>
          <td>
            <textarea name="opinion" id="" cols="30" rows="10"></textarea>
          </td>
        </tr>
      </table>
      <input type="submit" value="確認" class="submit_confirm">
    </form>
  </main>
</body>

</html>