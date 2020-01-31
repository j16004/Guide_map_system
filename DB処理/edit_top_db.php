<?php

    try {

        $user = "walking";
        $password = "walking";

        $dbh = new PDO("mysql:host=localhost; dbname=sport_db; charset=utf8", "$user", "$password");       

        $stmt = $dbh->query('SELECT * FROM pointers');

        $result = 0;

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
            echo 'エラーが発生しました。:' . $e->getMessage();
    }

?>