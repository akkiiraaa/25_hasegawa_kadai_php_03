<?php

//funcs.phpを呼び出す
require_once('funcs.php');

//1.  DB接続します
$pdo = db_conn();

//２．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare("SELECT * FROM hage_table");

//3. 実行
$status = $stmt->execute();

//4．データ表示
$view="";             //空の変数を作る
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  sql_error($status);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
         //GETデータ送信リンク作成
         $view .= "<p>";
         $view .= '<a href ="detail.php?id='.$result["id"].'">';  //<a>タグで囲う(update用)
         $view .= h($result['indate']).':'
                  .h($result["name"]).":"
                  .h($result["score"]).":"
                  .h($result["sex"]).":"
                  .h($result["age"]).":"
                  .h($result["height"]).":"
                  .h($result["weight"]).":"
                  .h($result["job"]).":"
                  .h($result["mail"]).":"
                  .h($result["sleep"]).":"
                  .h($result["work_stress"]).":"
                  .h($result["other_stress"]).":"
                  .h($result["food"]).":"
                  .h($result["meeting"]).":"
                  .h($result["mailmaga"]);
         $view .= "</a>";
         $view .= '<a href = "delete.php?id='.$result["id"].'">';  //<a>タグで囲う(delete用)
         $view .= "[削除]";
         $view .= "</a>";
         $view .= "</p>";
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ハゲ調データ</title>
<style>div{padding: 10px;font-size:16px;}</style>
</head>

<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
      <a href = "detail.php"></a>
      <?= $view ?>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>
