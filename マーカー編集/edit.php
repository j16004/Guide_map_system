
<?php
    require("DB/edit_page_get_db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!--CSSの読み込み-->
    <link rel="stylesheet" type="text/css" href="admin.css">
    <title>編集</title>

    <div class="contact-form">
        <h2>編集</h2>
        <form method="POST" action="edit_success.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php if (!empty($result['id'])) echo(htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8'));?>">
            <p>
                <label>タイトル：</label>
                <input type="text" name="title" required="required" value="<?php if (!empty($result['title'])) echo(htmlspecialchars($result['title'], ENT_QUOTES, 'UTF-8'));?>">
            </p>
            <p>
                <label>内容：</label>
                <input type="text" name="body" value="<?php if (!empty($result['body'])) echo(htmlspecialchars($result['body'], ENT_QUOTES, 'UTF-8'));?>">
                
            </p>
            <p>
                <label>サムネイルの変更（選択なしの場合、以前の画像を変更しません）：</label>
                <input type="file" name="fname" accept="image/*">
                <input type="hidden" name="img" value="<?php if (!empty($result['img'])) echo(htmlspecialchars($result['img'], ENT_QUOTES, 'UTF-8'));?>">
            </p>
            
            <button class="add_btn" type="submit" >適用する</button>

        </form>

    </div>
        <button class="home_link" type="button" onclick="location.href='edit_top.php'">戻る</button>
</body>
</html>