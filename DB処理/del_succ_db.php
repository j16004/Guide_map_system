<?php
    try {
    
        $user = "walking";
        $password = "walking";
        
        $dbh = new PDO("mysql:host=localhost; dbname=sport_db; charset=utf8",
            "$user", "$password");
        
        $stmt = $dbh->prepare('DELETE FROM pointers WHERE id = :id');
        
        $stmt->execute(array(':id' => $_GET["id"]));
        
        echo "削除が完了しました。";
    } catch (Exception $e) {
        echo 'エラーが発生しました。:' . $e->getMessage();
    }
?>