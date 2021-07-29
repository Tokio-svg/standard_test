<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>トップページ</title>
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
    <h1>トップページ</h1>
    <a href="/contact">お問い合わせ画面へ</a>
    <a href="/admin">管理システムへ</a>
  </main>
</body>

</html>