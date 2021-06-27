<?php

// 1. POSTデータ取得

$name           = $_POST["name"];
$score          = $_POST["score"];
$sex            = $_POST["sex"];
$age            = $_POST["age"];
$height         = $_POST["height"];
$weight         = $_POST["weight"];
$job            = $_POST["job"];
$mail           = $_POST["mail"];
$sleep          = $_POST["sleep"];
$work_stress    = $_POST["work_stress"];
$other_stress   = $_POST["other_stress"];
$food           = $_POST["food"];
$food           = join(",", $food);
$meeting        = $_POST["meeting"];
$mailmaga       = $_POST["mailmaga"];
$id             = $_POST["id"];


// 2. 関数を呼び出しDB接続
require_once("funcs.php");
$pdo = db_conn();


//３．データ更新SQL作成（UPDATE テーブル名 SET 更新対象1=:更新データ ,更新対象2=:更新データ2,... WHERE id = 対象ID;）
$stmt = $pdo->prepare(
  "UPDATE hage_table
   SET
   name     = :name,
   score    = :score,
   sex      = :sex,
   age      = :age,
   height   = :height,
   weight   = :weight,
   job      = :job,
   mail     = :mail,
   sleep    = :sleep,
   work_stress  = :work_stress,
   other_stress = :other_stress,
   food     = :food,
   meeting  = :meeting,
   mailmaga = :mailmaga,
   indate   = sysdate()
   WHERE
   id       = :id"
);





// 4. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':score', $score, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age', $age, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':height', $height, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':weight', $weight, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':job', $job, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':sleep', $sleep, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':work_stress', $work_stress, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':other_stress', $other_stress, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':food', $food, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':meeting', $meeting, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':mailmaga', $mailmaga, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();


// 6．データ登録処理後

if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    //以下を関数化
    sql_error($stmt);
  }else{
    //５．select.phpへリダイレクト
    //以下を関数化
    redirect("select.php");
  }