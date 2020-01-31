<?php
  require("DB/edit_top_db.php");

?>
 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!--CSSの読み込み-->
    <link rel="stylesheet" type="text/css" href="admin.css">
    <title>編集トップ</title>
  </head>
  <body> 
      <h2>編集トップ</h2>
        <?php
            echo "<table>\n";
            echo "<tr>\n";
            echo "<th>タイトル</th><th>内容</th><th>サムネイル</th><th>操作</th>\n";
            echo "</tr>\n";
            foreach ($result as $user) {
              echo "<tr>\n";
              echo "<td>" . $user["title"] . "</td>\n";
              echo "<td>" . $user["body"] . "</td>\n";
              echo "<td>" . $user["img"] . "</td>\n";

              echo "<td>\n";
              echo "<a class=edit_btn href=edit.php?id=" . $user["id"] . ">編　集</a>\n";
              echo "<a class=del_btn href=del_success.php?id=" . $user["id"] . ">削　除</a>\n";
              echo "<td>\n";

              echo "</tr>\n";
              }
            echo "</table>\n";
        ?>
      <br>
      <br>
      <button class="home_link" type="button" onclick="location.href='admin_home.php'">ホーム</button>
  </body>
</html>