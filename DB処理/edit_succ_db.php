<?php
    $img = $_POST['img'];

    $tempfile = $_FILES['fname']['tmp_name'];
    $filename = './upimg/' . $_FILES['fname']['name'];

    if ( move_uploaded_file($tempfile , $filename )) {
      //ファイル名をDBにも保存するための準備
      $success = $_FILES['fname']['name'];
    } else {
      //ファイルをアップロードしてもNo imageになるときは、アップロード先のパーミッションを確認する
      //画像をアップロードしない場合は、ここの処理は正常である
      $success = "No image.";
    }

    //新たに画像が設定されない場合、以前の画像をそのまま引き継ぐ
    if($success==="No image."){
      $success=$img;
    }

    try {

        $user = "walking";
        $password = "walking";

        $dbh = new PDO("mysql:host=localhost; dbname=sport_db; charset=utf8", "$user", "$password");

        // データベースのそれぞれのテーブルにデータをアップデートする準備をし、それを$stmt変数に定義する
        $stmt = $dbh->prepare('UPDATE pointers SET title = :title, body = :body,
           img = :img WHERE id = :id');

        $stmt->execute(array(':title' => $_POST['title'], ':body' => $_POST['body'],
         ':img' => $success,':id' => $_POST['id']));

        echo "情報を更新しました。";

    } catch (Exception $e) {
              echo 'エラーが発生しました。:' . $e->getMessage();
    }
?>