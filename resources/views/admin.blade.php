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
      <form action="/admin" method="post">
        @csrf
        <table>
          <tr>
            <th>お名前</th>
            <td>
              <input type="text" name="fullname" value="{{$inputs['fullname']}}">
            </td>
            <th>性別</th>
            <td>
              @if($inputs['gender'] === 1)
              <input type="radio" name="gender" value="3">全て
              <input type="radio" name="gender" value="1" checked>男性
              <input type="radio" name="gender" value="2">女性
              @elseif($inputs['gender'] === 2)
              <input type="radio" name="gender" value="3">全て
              <input type="radio" name="gender" value="1">男性
              <input type="radio" name="gender" value="2" checked>女性
              @else
              <input type="radio" name="gender" value="3" checked>全て
              <input type="radio" name="gender" value="1">男性
              <input type="radio" name="gender" value="2">女性
              @endif
            </td>
          </tr>
          <tr>
            <th>登録日</th>
            <td>
              <input type="date" name="date_start" value="{{$inputs['date_start']}}">~
              <input type="date" name="data_end" value="{{$inputs['date_end']}}">
            </td>
          </tr>
          <tr>
            <th>メールアドレス</th>
            <td>
              <input type="text" name="email" value="{{$inputs['email']}}">
            </td>
          </tr>
        </table>
        <input type="submit" value="検索">
        <p>リセット</p>
      </form>
    </div>
    <!-- 検索結果表示 -->
    <div class="search_result">
      {{$items->links()}}
      <table>
        <tr>
          <th>ID</th>
          <th>お名前</th>
          <th>性別</th>
          <th>メールアドレス</th>
          <th>ご意見</th>
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
          <td>{{$item->opinion}}</td>
          <td>
            <form action="/delete" method="post">
              @csrf
              <input type="hidden" name="id" value="{{$item->id}}">
              <input type="submit" value="削除">
            </form>
          </td>
        </tr>
        @endforeach
      </table>
    </div>
  </main>
</body>

</html>