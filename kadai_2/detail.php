<?php

require_once('funcs.php');      //関数を呼び出す
$pdo = db_conn();               //DBに接続

$id = $_GET["id"];              //対象のidを取得

$stmt = $pdo -> prepare("SELECT * FROM hage_user_table WHERE id = :id");
$stmt -> bindValue(':id', $id, PDO :: PARAM_INT);
$status = $stmt -> execute();

$view = "";
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}
?>


<!-- 以下はindex.phpからコピペ -->
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


<form action="update.php" method="POST">
    <div>ユーザー情報
        <ul>
            <li>氏名：<input type = "text" name = "name" value="<?= $result['name']?>"></li>
            <li>ログインID：<input type = "number" name = "lid" value="<?= $result['lid']?>" placeholder="メールアドレスをご入力ください"></li>
            <li>ログインPW：<input type="password" name="lpw" value="<?= $result['lpw']?>" id = "lpw" placeholder="パスワードをご入力ください"></li>
            <li>管理者フラグ：
                <br><input type = "radio" name = "kanri_flg" value="0" <?php if($result['kanri_flg'] === "0" ) echo 'checked="checked"' ?>>管理者
                <br><input type = "radio" name = "kanri_flg" value="1" <?php if($result['kanri_flg'] === "1" ) echo 'checked="checked"' ?>>スーパー管理者
            </li>
            <li>社員フラグ：
                <br><input type = "radio" name = "life_flg" value="0" <?php if($result['life_flg'] === "0" ) echo 'checked="checked"' ?>>退社
                <br><input type = "radio" name = "life_flg" value="1" <?php if($result['life_flg'] === "1" ) echo 'checked="checked"' ?>>入社
            </li>
        </ul>
    </div>

<input type="hidden" name="id" value="<?= $result['id']?>">
<input type="submit" value="更新">
</form>



</body>
</html>