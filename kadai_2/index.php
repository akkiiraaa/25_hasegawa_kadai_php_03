<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>【ユーザー管理】ハゲ調.com</title>
</head>
<body>
<header>
  <nav class="nav">
    <div class="container">
      <div class="navbar">
      <a href="select.php">ユーザー一覧</a>
      </div>
    </div>
  </nav>
</header>
<h1>ユーザー登録</h1>

<form action="insert.php" method="POST">
    <div>ユーザー情報
        <ul>
            <li>氏名：<input type = "text" name = "name"></li>
            <li>ログインID：<input type = "email" name = "lid" id = "lid" placeholder="メールアドレスをご入力ください"></li>
            <li>ログインPW：<input type="password" name="lpw" id = "lpw" placeholder="パスワードをご入力ください"></li>
            <li>管理者フラグ：
                <br><input type = "radio" name = "kanri_flg" value="0">管理者
                <br><input type = "radio" name = "kanri_flg" value="1">スーパー管理者
            </li>
            <li>社員フラグ：
                <br><input type = "radio" name = "life_flg" value="0">退社
                <br><input type = "radio" name = "life_flg" value="1">入社
            </li>
        </ul>
    </div>
<input type="submit" id = "submit" value="登録">
</form>

</body>
</html>