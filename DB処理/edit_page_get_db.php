<?php
    try {

        $user = "walking";
        $password = "walking";
    
        $dbh = new PDO("mysql:host=localhost; dbname=sport_db; charset=utf8", "$user", "$password");
    
        $stmt = $dbh->prepare('SELECT * FROM pointers WHERE id = :id');
    
        $stmt->execute(array(':id' => $_GET["id"]));
    
        $result = 0;
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    } catch (Exception $e) {
              echo 'エラーが発生しました。:' . $e->getMessage();
    }
?>