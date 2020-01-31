<!DOCTYPE html>
<html lang="ja">
    <head>
    <title><?php $this->assign('title', 'GoogleMapAPI'); ?></title>
    <!--マップのサイズ(元600px)-->
    <style>
        #maps{ height: 600px; }
    </style>
    
    </head>

    <body>
    <div id="maps"></div>

        <?php
            // DBに接続
            $pdo = new PDO("mysql:dbname=sport_db;host=localhost;charset=utf8mb4",
                "walking",
                "walking");

            // DBに接続できるかの確認処理
            if ($pdo) {
                //接続時は何もしない
            } else {
                "データベースに接続できませんでした。";
            }

            // pdoデータベースのpointersテーブルからカラムを選ぶ準備をして、$list変数に定義
            $list = $pdo->prepare("SELECT * FROM pointers");
            // データ取り出し実行
            $list->execute();

            $userData = array();

            //json形式で取り出し
            while ($row = $list->fetch(PDO::FETCH_ASSOC)) {
            $userData[]=array(
            'id'=>$row['id'],
            'title'=>$row['title'],
            'body'=>$row['body'],
            'lat'=>$row['lat'],
            'lng'=>$row['lng'],
            'img'=>$row['img']
            );
            }

            //json形式に変換し、jsonファイルに書き出し
            header('Content-type: application/json');
            $json = fopen('data.json','w+b');
            fwrite($json,json_encode($userData, JSON_UNESCAPED_UNICODE));
            fclose($json);

            

            // pdoデータベースのroutesテーブルからカラムを選ぶ準備をして、$roulist変数に定義
            $roulist = $pdo->prepare("SELECT * FROM routes");
            // データ取り出し実行
            $roulist->execute();

            $routeData = array();

            //json形式で取り出し
            while ($row_route = $roulist->fetch(PDO::FETCH_ASSOC)) {
            $routeData[]=array(
            'id'=>$row_route['id'],
            'lat1'=>$row_route['lat1'],
            'lng1'=>$row_route['lng1'],
            'lat2'=>$row_route['lat2'],
            'lng2'=>$row_route['lng2'],
            'lat3'=>$row_route['lat3'],
            'lng3'=>$row_route['lng3'],
            'lat4'=>$row_route['lat4'],
            'lng4'=>$row_route['lng4'],
            'lat5'=>$row_route['lat5'],
            'lng5'=>$row_route['lng5'],
            'lat6'=>$row_route['lat6'],
            'lng6'=>$row_route['lng6']
            );
            }

            //json形式に変換し、jsonファイルに書き出し
            header('Content-type: application/json');
            $route_json = fopen('route.json','w+b');
            fwrite($route_json,json_encode($routeData, JSON_UNESCAPED_UNICODE));
            fclose($route_json);
            
        ?>

        <!--以下よりtest.jsによる処理を読み込む-->
        <!--cakePHPでの.jsファイルの指定方法-->
        <?php echo $this->Html->script( './map.js'); ?>
        <!--通常のWebサーバの場合は、以下のように.jsファイルを指定-->
        <!--<script src="./map.js"></script>-->
        <script src="https://maps.googleapis.com/maps/api/js?key=KEY" async></script>

    </body>
</html>
