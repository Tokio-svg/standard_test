<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>内容確認</title>
  <!-- スタイルシート読み込み -->
  @if(app('env')=='local')
  <link rel="stylesheet" href="{{asset('/css/reset.css')}}">
  <!-- <link rel="stylesheet" href="{{asset('/css/style.css')}}"> -->
  @else
  <link rel="stylesheet" href="{{secure_asset('/css/reset.css')}}">
  <!-- <link rel="stylesheet" href="{{secure_asset('/css/style.css')}}"> -->
  @endif
</head>

<body>
  <main>
    <h1>内容確認</h1>
    <!-- メモ：form + input(hidden)で受け取ったデータを保持しておく -->
    <!-- $inputsの中に入力内容が含まれている -->
    <form action="/thanks" method="post">
      <table>
        <tr>
          <th>お名前</th>
          <td>
            {{$family_name}}
            {{$first_name}}
          </td>
        </tr>
        <tr>
          <th>性別</th>
          <td>
            {{$gender}}
          </td>
        </tr>
        <tr>
          <th>メールアドレス</th>
          <td>
            {{$email}}
          </td>
        </tr>
        <tr>
          <th>郵便番号</th>
          <td>
            {{$postcode}}
          </td>
        </tr>
        <tr>
          <th>住所</th>
          <td>
            {{$address}}
          </td>
        </tr>
        <tr>
          <th>建物名</th>
          <td>
            {{$building_name}}
          </td>
        </tr>
        <tr>
          <th>ご意見</th>
          <td>
            {{$opinion}}
          </td>
        </tr>
      </table>
      <input type="submit" value="送信" class="submit_send">
      <p>
        <a href="#">修正する</a>
      </p>
    </form>
  </main>
</body>

</html>