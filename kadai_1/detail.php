<?php

require_once('funcs.php');      //関数を呼び出す
$pdo = db_conn();               //DBに接続

$id = $_GET["id"];              //対象のidを取得

$stmt = $pdo -> prepare("SELECT * FROM hage_table WHERE id = :id");
$stmt -> bindValue(':id', $id, PDO :: PARAM_INT);
$status = $stmt -> execute();

$view = "";
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}

 
// var_dump ($result['food']) ;
// exit ();

$foods = explode(",", $result['food']);
// $test = array_search ( 'ステーキ' , $foods );
// echo $test;
// var_dump($foods);
// exit ();
?>


<!-- 以下はindex.phpからコピペ -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ハゲ調.com</title>
</head>
<body>
<header>
  <nav class="nav">
    <div class="container">
      <div class="navbar">
      <a href="select.php">データ一覧</a>
      </div>
    </div>
  </nav>
</header>



<h1>ハゲの生活習慣調査</h1>
<p>調査結果を元に薄毛の原因を推測し、改善策をご提案いたします！</p>

<form action="update.php" method="POST">
    <div>基本情報
        <ul>
            <li>氏名：<input type = "text" name = "name" value="<?= $result['name']?>"></li>
            <li>薄毛スコア：<input type = "number" name = "score" value="<?= $result['score']?>" placeholder="1〜100の数字でご入力ください"></li>
            <a href="#">薄毛スコアはここでチェック！</a>
            <li>
                性別：
                <br><input type = "radio" name = "sex" value="男" <?php if($result['sex'] === '男') echo 'checked="checked"' ?>>男
                <br><input type = "radio" name = "sex" value="女" <?php if($result['sex'] === '女') echo 'checked="checked"' ?>>女
                <br><input type = "radio" name = "sex" value="その他" <?php if($result['sex'] === 'その他') echo 'checked="checked"' ?>>その他
            </li>
            <li>年齢：<input type = "number" name = "age" value="<?= $result['age']?>" placeholder="数字でご入力ください"></li>
            <li>身長(cm)：<input type = "number" name = "height" value="<?= $result['height']?>" placeholder="数字でご入力ください"></li>
            <li>体重(kg)：<input type = "number" name = "weight" value="<?= $result['weight']?>" placeholder="数字でご入力ください"></li>
            <li>職業：<input type = "text" name = "job" value="<?= $result['job']?>"></li>
            <li>mail：<input type = "text" name = "mail" value="<?= $result['mail']?>"></li>
        </ul>
    </div>

    <div>アンケート
        <ul>
            <li>直近３ヶ月の平均的な睡眠時間を教えてください
            <br><select name="sleep">
                <option value="3時間以下" <?php if( $result['sleep'] === '3時間以下') echo 'selected="true"' ?>>3時間以下</option>
                <option value="4時間"  <?php if( $result['sleep'] === '4時間') echo 'selected="true"' ?>>4時間</option>
                <option value="5時間" <?php if( $result['sleep'] === '5時間') echo 'selected="true"' ?>>5時間</option>
                <option value="6時間" <?php if( $result['sleep'] === '6時間') echo 'selected="true"' ?>>6時間</option>
                <option value="7時間" <?php if( $result['sleep'] === '7時間') echo 'selected="true"' ?>>7時間</option>
                <option value="8時間以上" <?php if( $result['sleep'] === '8時間以上') echo 'selected="true"' ?>>8時間以上</option>
            </select>    
            
            </li>
            <li>直近３ヶ月の会社（学生の方は学校）での状況として当てはまるものはどれですか？
                <br><select name="work_stress" id="">
                    <option value="つらい" <?php if( $result['work_stress'] === 'つらい') echo 'selected="true"' ?>>つらい</option>
                    <option value="普通" <?php if( $result['work_stress'] === '普通') echo 'selected="true"' ?>>普通</option>
                    <option value="充実" <?php if( $result['work_stress'] === '充実') echo 'selected="true"' ?>>充実</option>
                </select>
            </li>
            <li>直近３ヶ月の家庭やプライベートの状況として当てはまるものはどれですか？
                <br><select name="other_stress" id="">
                    <option value="つらい" <?php if( $result['other_stress'] === 'つらい') echo 'selected="true"' ?>>つらい</option>
                    <option value="普通" <?php if( $result['other_stress'] === '普通') echo 'selected="true"' ?>>普通</option>
                    <option value="充実" <?php if( $result['other_stress'] === '充実') echo 'selected="true"' ?>>充実</option>
                </select>
            </li>
            <li>つぎの食べもののうち好んで食べるものを全て選択してください<br>
                <input type = "checkbox" name = "food[]" value="からあげ" <?php if( array_search ( "からあげ" , $foods ) === 0 || array_search ( "からあげ" , $foods ) != false ) echo 'checked="checked"' ?>>からあげ
                <input type = "checkbox" name = "food[]" value="ハンバーグ" <?php if( array_search ( "ハンバーグ" , $foods ) === 0 || array_search ( "ハンバーグ" , $foods ) != false ) echo 'checked="checked"' ?>>ハンバーグ
                <input type = "checkbox" name = "food[]" value="ステーキ" <?php if( array_search ( "ステーキ" , $foods ) === 0 || array_search ( "ステーキ" , $foods ) != false ) echo 'checked="checked"' ?>>ステーキ
                <input type = "checkbox" name = "food[]" value="焼肉" <?php if( array_search ( "焼肉" , $foods ) === 0 || array_search ( "焼肉" , $foods ) != false ) echo 'checked="checked"' ?>>焼肉
                <input type = "checkbox" name = "food[]" value="ギョウザ" <?php if( array_search ( "ギョウザ" , $foods ) === 0 || array_search ( "ギョウザ" , $foods ) != false ) echo 'checked="checked"' ?>>ギョウザ
                <input type = "checkbox" name = "food[]" value="ラーメン" <?php if( array_search ( "ラーメン" , $foods ) === 0 || array_search ( "ラーメン" , $foods ) != false ) echo 'checked="checked"' ?>>ラーメン
                <input type = "checkbox" name = "food[]" value="天ぷら" <?php if( array_search ( "天ぷら" , $foods ) === 0 || array_search ( "天ぷら" , $foods ) != false ) echo 'checked="checked"' ?>>天ぷら
                <br><input type = "checkbox" name = "food[]" value="なし" <?php if( array_search ( "なし" , $foods ) === 0 || array_search ( "なし" , $foods ) != false ) echo 'checked="checked"' ?>>上記に好きな食べものはない
            </li>
        </ul>
    </div>

    <div>その他
        <ul>
            <li>マンツーマンの面談によるより専門的なアドバイスを希望しますか？：
                <br><input type = "radio" name = "meeting" value="はい" <?php if($result['meeting'] === 'はい') echo 'checked="checked"' ?>>はい
                <br><input type = "radio" name = "meeting" value="いいえ" <?php if($result['meeting'] === 'いいえ') echo 'checked="checked"' ?>>いいえ
            </li>
            <li>ハゲ調.comからのメルマガ配信を希望しますか？：
                <br><input type = "radio" name = "mailmaga" value="はい" <?php if($result['mailmaga'] === 'はい') echo 'checked="checked"' ?>>はい
                <br><input type = "radio" name = "mailmaga" value="いいえ" <?php if($result['mailmaga'] === 'いいえ') echo 'checked="checked"' ?>>いいえ
            </li>
        </ul>
    </div>

<input type="hidden" name="id" value="<?= $result['id']?>">
<input type="submit" value="更新">
</form>



</body>
</html>