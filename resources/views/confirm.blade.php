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
  <link rel="stylesheet" href="{{asset('/css/confirm_style.css')}}">
  @else
  <link rel="stylesheet" href="{{secure_asset('/css/reset.css')}}">
  <link rel="stylesheet" href="{{secure_asset('/css/confirm_style.css')}}">
  @endif
</head>

<body>
  <main>
    <h1>内容確認</h1>
    <form action="/create" method="post">
      @csrf
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
            @if($gender === 1)
            男性
            @else
            女性
            @endif
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
      <!-- 送信用hiddenフォーム -->
      <input type="hidden" name="family_name" value="{{$family_name}}">
      <input type="hidden" name="first_name" value="{{$first_name}}">
      <input type="hidden" name="gender" value="{{$gender}}">
      <input type="hidden" name="email" value="{{$email}}">
      <input type="hidden" name="postcode" value="{{$postcode}}">
      <input type="hidden" name="address" value="{{$address}}">
      <input type="hidden" name="building_name" value="{{$building_name}}">
      <input type="hidden" name="opinion" value="{{$opinion}}">

      <input type="submit" value="送信" class="submit__send">
    </form>
    <!-- 修正リンク -->
    <form action="/contact" method="post">
      @csrf
      <!-- 送信用hiddenフォーム -->
      <input type="hidden" name="family_name" value="{{$family_name}}">
      <input type="hidden" name="first_name" value="{{$first_name}}">
      <input type="hidden" name="gender" value="{{$gender}}">
      <input type="hidden" name="email" value="{{$email}}">
      <input type="hidden" name="postcode" value="{{$postcode}}">
      <input type="hidden" name="address" value="{{$address}}">
      <input type="hidden" name="building_name" value="{{$building_name}}">
      <input type="hidden" name="opinion" value="{{$opinion}}">

      <input type="submit" value="修正する" class="submit__fix">
    </form>
  </main>
</body>

</html>