<?php

  //本来はidは1のみ使い続ける
  $id = 20;
  try {

    $user = "walking";
    $password = "walking";

    $dbh = new PDO("mysql:host=localhost; dbname=sport_db; charset=utf8", "$user", "$password");

    // データベースのそれぞれのテーブルにデータをアップデートする準備をし、それを$stmt変数に定義する
    $stmt = $dbh->prepare('UPDATE routes SET lat1 = :lat1, lng1 = :lng1, lat2 = :lat2, lng2 = :lng2, lat3 = :lat3, lng3 = :lng3,
    lat4 = :lat4, lng4 = :lng4, lat5 = :lat5, lng5 = :lng5, lat6 = :lat6, lng6 = :lng6 WHERE id = :id');

    $stmt->execute(array(
      ':lat1' => $_POST['lat1'], ':lng1' => $_POST['lng1'], 
      ':lat2' => $_POST['lat2'], ':lng2' => $_POST['lng2'],
      ':lat3' => $_POST['lat3'], ':lng3' => $_POST['lng3'], 
      ':lat4' => $_POST['lat4'], ':lng4' => $_POST['lng4'], 
      ':lat5' => $_POST['lat5'], ':lng5' => $_POST['lng5'], 
      ':lat6' => $_POST['lat6'], ':lng6' => $_POST['lng6'],
      ':id' => $id
    ));

    echo "情報を更新しました。";
    header('Location: route_out.php');
} catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
}
  ?>