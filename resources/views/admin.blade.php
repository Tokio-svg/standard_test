<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理システム</title>
  <!-- スタイルシート読み込み -->
  @if(app('env')=='local')
  <link rel="stylesheet" href="{{asset('/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('/css/admin_style.css')}}">
  @else
  <link rel="stylesheet" href="{{secure_asset('/css/reset.css')}}">
  <link rel="stylesheet" href="{{secure_asset('/css/admin_style.css')}}">
  @endif
</head>

<body>
  <main>
    <h1>管理システム</h1>
    <!-- 検索用入力フォーム -->
    <div class="search__wrap">
      <form action="/admin/search" method="get">
        <table class="input__table">
          <tr>
            <th>お名前</th>
            <td>
              <input type="text" name="fullname" value="{{$inputs['fullname']}}" class="input__text">
            </td>
            <th>性別</th>
            <td>
              @if($inputs['gender'] == 1)
              <input type="radio" name="gender" class="input__gender" value="3">全て
              <input type="radio" name="gender" class="input__gender" value="1" checked>男性
              <input type="radio" name="gender" class="input__gender" value="2">女性
              @elseif($inputs['gender'] == 2)
              <input type="radio" name="gender" class="input__gender" value="3">全て
              <input type="radio" name="gender" class="input__gender" value="1">男性
              <input type="radio" name="gender" class="input__gender" value="2" checked>女性
              @else
              <input type="radio" name="gender" class="input__gender" value="3" checked>全て
              <input type="radio" name="gender" class="input__gender" value="1">男性
              <input type="radio" name="gender" class="input__gender" value="2">女性
              @endif
            </td>
          </tr>
          <tr>
            <th>登録日</th>
            <td>
              <input type="date" name="date_start" value="{{$inputs['date_start']}}" class="input__text">~
              <input type="date" name="date_end" value="{{$inputs['date_end']}}" class="input__text">
            </td>
          </tr>
          <tr>
            <th>メールアドレス</th>
            <td>
              <input type="text" name="email" value="{{$inputs['email']}}" class="input__text">
            </td>
          </tr>
        </table>
        <input type="submit" value="検索" class="submit__search">
        <div class="a__reset--wrap">
          <a href="/admin" class="a__reset">リセット</a>
        </div>
      </form>
    </div>
    <!-- 検索結果表示 -->
    <div class="search__result">
      {{$items->appends(request()->query())->links('vendor.pagination.default_custom')}}
      <table class="result__table">
        <tr>
          <th>ID</th>
          <th>お名前</th>
          <th>性別</th>
          <th>メールアドレス</th>
          <th>ご意見</th>
          <th></th>
        </tr>
        @foreach ($items as $item)
        <tr>
          <td>{{$item->id}}</td>
          <td>{{$item->fullname}}</td>
          <td>
            @if($item->gender === 1)
            男性
            @else
            女性
            @endif
          </td>
          <td>{{$item->email}}</td>
          <td>
            <p id="opinion_{{$item->id}}" onmouseover="exchangeText(this.id)" onmouseout="exchangeText(this.id)">
              <?php
              if (mb_strlen($item->opinion) >= 25) {
                $short = mb_substr($item->opinion, 0, 25);
                echo $short . '...';
              } else {
                echo $item->opinion;
              }
              ?>
            </p>
            <div style="display: none;">{{$item->opinion}}</div>
          </td>
          <td>
            <form action="/delete" method="post" onsubmit="return confirmDelete()">
              @csrf
              <!-- 削除対象のidと現在のURLをpost送信 -->
              <input type="hidden" name="id" value="{{$item->id}}">
              <input type="hidden" name="url" value="{{$_SERVER['REQUEST_URI']}}">
              <input type="submit" value="削除" class="submit__delete">
            </form>
          </td>
        </tr>
        @endforeach
      </table>
    </div>
  </main>
  <script>
    // 関数：削除の確認ダイアログを表示
    function confirmDelete() {
      if (!window.confirm("削除します。よろしいですか？")) {
        return false;
      }
    }

    // 関数：引数のidを持つ要素と次の要素のtextContentを入れ替える
    function exchangeText(id) {
      const element = document.getElementById(id);
      const tmp = element.textContent;
      const nextElement = element.nextElementSibling;

      element.textContent = nextElement.textContent;
      nextElement.textContent = tmp;
    }
  </script>
</body>

</html>