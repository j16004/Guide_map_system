<?php

  // postにデータがあるとき実行
  if (isset($_POST["title"], $_POST["body"], $_POST["lat"], $_POST["lng"])) {
    //ポストのデータを変数にする
    $title = $_POST["title"];
    $body = $_POST["body"];
    $lat = $_POST["lat"];
    $lng = $_POST["lng"];
  }

  //DBに接続
  $pdo = new PDO(
    "mysql:dbname=sport_db;host=localhost","walking","walking",
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
  );
  // DBに繋がっているか確認。
  if ($pdo) {

  } else {
    "データベースに接続できませんでした。";
  }

  // DBのそれぞれのテーブルにデータをインサートする準備をし、それを$regist変数に定義する
  $regist = $pdo->prepare("INSERT INTO pointers(title,body,lat,lng,img) VALUES (?,?,?,?,?)");

  // インサートのルールを決める
  // DBのそれぞれのカラムに上で定義した変数の値をインサート
  $regist->bindParam("title", $title);
  $regist->bindParam("body", $body);
  $regist->bindParam("lat", $lat);
  $regist->bindParam("lng", $lng);
  
  if ($regist) {
    //サムネイル送信処理*
    $tempfile = $_FILES['fname']['tmp_name'];
    $filename = './upimg/' . $_FILES['fname']['name'];

        if ( move_uploaded_file($tempfile , $filename )) {
          //ファイル名をDBにも保存するための準備
          $success = $_FILES['fname']['name'];
          echo $success . "をアップロードしました。";
        } else {
          //ファイルをアップロードしてもNo imageになるときは、アップロード先のパーミッションを確認する
          //画像をアップロードしない場合は、ここの処理は正常である
          $success = "No image.";
        }
  } else {
    echo "エラーが発生しました。イメージフォルダのパーミッションを確認してください。";
  }

  $regist->bindParam("img", $success);
  // データをDBへインサートする
  $regist->execute(array($title, $body, $lat, $lng, $success));

  header('Location: admin_point_input.php');
  ?>