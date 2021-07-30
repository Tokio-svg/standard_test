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
  @else
  <link rel="stylesheet" href="{{secure_asset('/css/reset.css')}}">
  @endif
  <style>
    main {
      width: 35%;
      margin: 0 auto;
      padding: 30px;
      line-height: 1.2em;
      text-align: center;
    }

    a {
      border: none;
      width: 180px;
      height: 35px;
      display: block;
      margin: 20px auto;
      background: rgb(0, 0, 0);
      color: white;
      cursor: pointer;
      border-radius: 5px;
      text-decoration: none;
      line-height: 35px;
      font-size: 13px;
    }
  </style>
</head>

<body>
  <main>
    <h1>トップページ</h1>
    <a href="/contact">お問い合わせ画面へ</a>
    <a href="/admin">管理システムへ</a>
  </main>
</body>

</html>