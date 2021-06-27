<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}


//DB接続関数
function db_conn(){
try {
    $db_name    = "hage_db";
    $db_id      = "root";
    $db_pw      = "root";
    $db_host    = "localhost";
    $pdo        = new PDO('mysql:dbname='
                        . $db_name
                        . ';charset=utf8;host='
                        . $db_host, $db_id, $db_pw);
    return $pdo;    //returnしないと$pdoが外に出ない！（関数の外に出ていない時は$pdoの青色が暗くなるぽい）
} catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }
}


//SQLエラー関数
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:" . print_r($error, true));
}


//リダイレクト関数
function redirect ($file_name){
    header('Location:' .$file_name);
    exit();
}