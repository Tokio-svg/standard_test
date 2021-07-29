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
          <td class="td__flex">
            <div class="name__wrap">
              <input type="text" name="family_name" value="{{$family_name}}">
              <p class="example">例）山田</p>
              @error('family_name')
              <p class="red">{{$message}}</p>
              @enderror
            </div>
            <div class="name__wrap">
              <input type="text" name="first_name" value="{{$first_name}}">
              <p class="example">例）太郎</p>
              @error('first_name')
              <p class="red">{{$message}}</p>
              @enderror
            </div>
          </td>
        </tr>
        <tr>
          <th>性別<span class="red">※</span></th>
          <td>
            @if($gender === 1)
            <input type="radio" name="gender" value="1" class="input__gender" checked><span class="gender__text">男性</span>
            <input type="radio" name="gender" value="2" class="input__gender"><span class="gender__text">女性</span>
            @else
            <input type="radio" name="gender" value="1" class="input__gender"><span class="gender__text">男性</span>
            <input type="radio" name="gender" value="2" class="input__gender" checked><span class="gender__text">女性</span>
            @endif
            @error('gender')
            <p class="red">{{$message}}</p>
            @enderror
          </td>
        </tr>
        <tr>
          <th>メールアドレス<span class="red">※</span></th>
          <td>
            <input type="text" name="email" value="{{$email}}">
            <p class="example">例）test@example.com</p>
            @if ($errors->has('email'))
            @foreach($errors->get('email') as $message)
            <p class="red">{{$message}}</p>
            @endforeach
            @endif
          </td>
        </tr>
        <tr>
          <th>郵便番号<span class="red">※</span></th>
          <td class="td__flex">
            <p>〒</p>
            <div class="postcode__wrap">
              <input type="text" name="postcode" value="{{$postcode}}">
              <p class="example">例）123-4567</p>
              @if ($errors->has('postcode'))
              @foreach($errors->get('postcode') as $message)
              <p class="red">{{$message}}</p>
              @endforeach
              @endif
            </div>
          </td>
        </tr>
        <tr>
          <th>住所<span class="red">※</span></th>
          <td>
            <input type="text" name="address" value="{{$address}}">
            <p class="example">例）東京都渋谷区千駄ヶ谷1-2-3</p>
            @error('address')
            <p class="red">{{$message}}</p>
            @enderror
          </td>
        </tr>
        <tr>
          <th>建物名</th>
          <td>
            <input type="text" name="building_name" value="{{$building_name}}">
            <p class="example">例）千駄ヶ谷マンション101</p>
          </td>
        </tr>
        <tr>
          <th>ご意見<span class="red">※</span></th>
          <td>
            <textarea name="opinion" id="opinion" cols="30" rows="10"></textarea>
            @if ($errors->has('opinion'))
            @foreach($errors->get('opinion') as $message)
            <p class="red">{{$message}}</p>
            @endforeach
            @endif
          </td>
        </tr>
      </table>
      <input type="submit" value="確認" class="submit_confirm">
    </form>
  </main>
  <script>
    document.getElementById("opinion").value = "{{$opinion}}";
  </script>
</body>

</html>