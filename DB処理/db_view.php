<?php

	// DBに接続
	$pdo = new PDO("mysql:dbname=sport_db;host=localhost;charset=utf8mb4",
	"walking",
	"walking");

	// DB繋がっているか確認
	if ($pdo) {

	} else {
		"データベースに接続できませんでした。";
	}

	// pdoデータベースのpointersテーブルからカラムを選ぶ準備をして、$list変数のに定義
	$list = $pdo->prepare("SELECT * FROM pointers");
	// 取り出し実行
	$list->execute();

	if ($list) {
		echo "
		<br>
		<br>
			<table border=1>
				<caption>
					<h2>データベース登録情報</h2>
				</caption>
				<tr>
					<th>ID</th>
					<th>タイトル</th>
					<th>内容</th>
					<th>緯度</th>
					<th>経度</th>
					<th>サムネイル</th>
				</tr>
		";
		
		while ($data = $list->fetch()) {
			echo "
					<tr>
						<th>{$data['id']}</th>
						<th>{$data['title']}</th>
						<th>{$data['body']}</th>
						<th>{$data['lat']}</th>
						<th>{$data['lng']}</th>
						<th>{$data['img']}</th>
					</tr>
			";
		}
	} else {
		echo "エラーです。";
	}

	echo "</table>";
	

?>