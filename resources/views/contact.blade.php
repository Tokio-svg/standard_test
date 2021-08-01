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
    <form action="/confirm" method="post" class="form__create h-adr" onsubmit="return false;">
      <span class="p-country-name" style="display:none;">Japan</span>
      @csrf
      <table>
        <tr>
          <th>お名前<span class="red">※</span></th>
          <td class="td__flex">
            <div class="name__wrap">
              <!-- リダイレクト時はoldの内容を格納する -->
              <?php
              if (!is_null(old('family_name'))) {
                $family_name = old('family_name');
              }
              ?>
              <input type="text" name="family_name" id="family_name" value="{{$family_name}}" onblur="validateRequire(this.id,'error_family_name')">
              <p class="example">例）山田</p>
              <!-- エラーメッセージ -->
              @error('family_name')
              <p class="red">{{$message}}</p>
              @enderror
              <!-- Laravelのエラーメッセージが表示されていない場合は入力時エラーメッセージを表示する -->
              @if (!$errors->has('family_name'))
              <p id="error_family_name" class="red" style="display: none;">苗字を入力してください</p>
              @endif
            </div>
            <div class="name__wrap">
              <!-- リダイレクト時はoldの内容を格納する -->
              <?php
              if (!is_null(old('first_name'))) {
                $first_name = old('first_name');
              }
              ?>
              <input type="text" name="first_name" id="first_name" value="{{$first_name}}" onblur="validateRequire(this.id,'error_first_name')">
              <p class="example">例）太郎</p>
              <!-- エラーメッセージ -->
              @error('first_name')
              <p class="red">{{$message}}</p>
              @enderror
              <!-- Laravelのエラーメッセージが表示されていない場合は入力時エラーメッセージを表示する -->
              @if (!$errors->has('first_name'))
              <p id="error_first_name" class="red" style="display: none;">名前を入力してください</p>
              @endif
            </div>
          </td>
        </tr>
        <tr>
          <th>性別<span class="red">※</span></th>
          <td>
            <!-- リダイレクト時はoldの内容を格納する -->
            <?php
            if (!is_null(old('gender'))) {
              $gender = old('gender');
            }
            ?>
            @if($gender === 1)
            <input type="radio" name="gender" value="1" class="input__gender" checked><span class="gender__text">男性</span>
            <input type="radio" name="gender" value="2" class="input__gender"><span class="gender__text">女性</span>
            @else
            <input type="radio" name="gender" value="1" class="input__gender"><span class="gender__text">男性</span>
            <input type="radio" name="gender" value="2" class="input__gender" checked><span class="gender__text">女性</span>
            @endif
            <!-- エラーメッセージ -->
            @error('gender')
            <p class="red">{{$message}}</p>
            @enderror
          </td>
        </tr>
        <tr>
          <th>メールアドレス<span class="red">※</span></th>
          <td>
            <!-- リダイレクト時はoldの内容を格納する -->
            <?php
            if (!is_null(old('email'))) {
              $email = old('email');
            }
            ?>
            <input type="email" name="email" id="email" value="{{$email}}" onblur="validateRequire(this.id,'error_email');validateEmail()">
            <p class="example">例）test@example.com</p>
            <!-- エラーメッセージ -->
            @if ($errors->has('email'))
            @foreach($errors->get('email') as $message)
            <p class="red">{{$message}}</p>
            @endforeach
            @endif
            <!-- Laravelのemailに関するエラーが無い、
            もしくはエラーはあるが該当するルールのエラーが無い場合は入力時エラーメッセージを表示する -->
            <?php
            $require = false;
            $email = false;
            if ($errors->has('email')) {
              $text = '';
              foreach ($errors->get('email') as $message) {
                $text .= $message;
              }
              if (strpos($text, '形式') === false) {
                $email = true;
              } else {
                $require = true;
              }
            }
            if (!$errors->has('email') || $require === true) {
              echo "<p id='error_email' class='red' style='display: none;'>メールアドレスを入力してください</p>";
            }
            if (!$errors->has('email') || $email === true) {
              echo "<p id='error_email-type' class='red' style='display: none;'>メールアドレスの形式で入力してください</p>";
            }
            ?>
          </td>
        </tr>
        <tr>
          <th>郵便番号<span class="red">※</span></th>
          <td class="td__flex">
            <p class="postmark">〒</p>
            <div class="postcode__wrap">
              <!-- リダイレクト時はoldの内容を格納する -->
              <?php
              if (!is_null(old('postcode'))) {
                $postcode = old('postcode');
              }
              ?>
              <input type="text" name="postcode" id="postcode" class="p-postal-code" value="{{$postcode}}" maxlength="8" onblur="validatePostcode()">
              <p class="example">例）123-4567</p>
              <!-- エラーメッセージ -->
              @if ($errors->has('postcode'))
              @foreach($errors->get('postcode') as $message)
              <p class="red">{{$message}}</p>
              @endforeach
              @endif
              <p id="error_postcode" class="red" style="display: none;">郵便番号は数字とハイフンからなる8文字を入力してください</p>
            </div>
          </td>
        </tr>
        <tr>
          <th>住所<span class="red">※</span></th>
          <td>
            <!-- リダイレクト時はoldの内容を格納する -->
            <?php
            if (!is_null(old('address'))) {
              $address = old('address');
            }
            ?>
            <input type="text" name="address" value="{{$address}}" id="address" class="p-region p-locality p-street-address p-extended-address" onblur="validateRequire(this.id,'error_address')">
            <p class="example">例）東京都渋谷区千駄ヶ谷1-2-3</p>
            <!-- エラーメッセージ -->
            @error('address')
            <p class="red">{{$message}}</p>
            @enderror
            <!-- Laravelのエラーメッセージが表示されていない場合は入力時エラーメッセージを表示する -->
            @if (!$errors->has('address'))
            <p id="error_address" class="red" style="display: none;">住所を入力してください</p>
            @endif
          </td>
        </tr>
        <tr>
          <th>建物名</th>
          <td>
            <!-- リダイレクト時はoldの内容を格納する -->
            <?php
            if (!is_null(old('building_name'))) {
              $building_name = old('building_name');
            }
            ?>
            <input type="text" name="building_name" id="building_name" value="{{$building_name}}">
            <p class="example">例）千駄ヶ谷マンション101</p>
          </td>
        </tr>
        <tr>
          <th>ご意見<span class="red">※</span></th>
          <td>
            <textarea name="opinion" id="opinion" onblur="validateRequire(this.id,'error_opinion')" oninput="validateMax(this.id)"></textarea>
            <!-- エラーメッセージ -->
            @if ($errors->has('opinion'))
            @foreach($errors->get('opinion') as $message)
            <p class="red">{{$message}}</p>
            @endforeach
            @endif
            <p id="error_opinion" class="red" style="display: none;">ご意見を入力してください</p>
            <p id="error_opinion-max" class="red" style="display: none;">ご意見は120文字以内に収めてください</p>
          </td>
        </tr>
      </table>
      <input type="button" value="確認" class="submit_confirm" onclick="submit()">
    </form>
  </main>
  <script>
    // リクエストからご意見の値を設定
    // リダイレクト時はoldの内容を格納する
    if ("{{old('opinion')}}") {
      document.getElementById("opinion").value = "{{old('opinion')}}";
    } else {
      document.getElementById("opinion").value = "{{$opinion}}";
    }

    // 関数：入力必須バリデーション
    function validateRequire(id, errorId) {
      const errorMessage = document.getElementById(errorId);
      // 該当のエラーメッセージ要素が存在しない場合は終了
      if (!errorMessage) {
        return;
      }
      const input = document.getElementById(id).value;
      if (!input) {
        errorMessage.style.display = "block";
      } else {
        errorMessage.style.display = "none";
      }
    }

    // 関数：メールアドレス形式バリデーション
    // 1文字以上 @ 1文字以上 . 1文字以上の形の文字列をメールアドレス形式とする
    function validateEmail() {
      const errorMessage = document.getElementById('error_email-type');
      // 該当のエラーメッセージ要素が存在しない場合は終了
      if (!errorMessage) {
        return;
      }
      const input = document.getElementById("email").value;
      // 未入力の場合は終了
      if (!input) {
        errorMessage.style.display = "none"
        return;
      }
      if (!input.match(/.+@.+\..+/)) {
        errorMessage.style.display = "block";
      } else {
        errorMessage.style.display = "none";
      }
    }

    // 関数：郵便番号バリデーション
    // 入力欄がフォーカスを失った時に
    // (1)全角を半角に変換
    // (2)郵便番号かどうかチェック
    // (3)不正な入力の場合はエラーメッセージタグのクラスを切り替えて表示させる
    function validatePostcode() {
      const input = document.getElementById("postcode").value;
      input = toHalfSize(input);
      if (!isPostcode(input)) {
        document.getElementById('error_postcode').style.display = "block";
      } else {
        document.getElementById('error_postcode').style.display = "none";
      }
    }

    // 関数：全角の数字と‐,－,―を半角に変換する
    function toHalfSize(str) {
      return str.replace(/[０-９]/g, function(s) {
          return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
        })
        .replace(/[‐－―]/g, "-");
    }

    // 関数：郵便番号かどうかチェックする（真偽値で返す）
    function isPostcode(str) {
      if (str.match(/^\d{3}-\d{4}$/)) {
        return true;
      } else {
        return false;
      }
    }

    // 関数：ご意見の入力値に変化があったら文字数をカウントして120文字を超えていたらエラーメッセージを表示する
    function validateMax(id) {
      const input = document.getElementById(id);
      if (input.value.length > 120) {
        document.getElementById('error_opinion-max').style.display = "block";
      } else {
        document.getElementById('error_opinion-max').style.display = "none";
      }
    }
  </script>
  <!-- 住所の自動入力にYubinBangoライブラリを使用 -->
  <!-- URL: https://github.com/yubinbango/yubinbango -->
  <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
</body>

</html>