<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>マーカー情報入力フォーム|管理者</title>
        <!--CSSの読み込み-->
        <link rel="stylesheet" type="text/css" href="admin.css">

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=KEY"></script>
        <script type="text/javascript">
        /* ========================================================================
        Attribute Latitude And Longitude From Address With Google Maps API
        ========================================================================== */
        $(function(){
            function attrLatLngFromAddress(address){
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({'address': address}, function(results, status){
                    if(status == google.maps.GeocoderStatus.OK) {
                        var lat = results[0].geometry.location.lat();
                        var lng = results[0].geometry.location.lng();
                        // 小数点第六位以下を四捨五入した値を緯度経度にセット、小数点以下の値が第六位に満たない場合は0埋め
                        document.getElementById("latitude").value = (Math.round(lat * 1000000) / 1000000).toFixed(6);
                        document.getElementById("longitude").value = (Math.round(lng * 1000000) / 1000000).toFixed(6);
                    }
                });
            }

            $('#search').click(function(){
                search_run();
            
                function search_run(){
                    var address = document.getElementById("address").value;
                    attrLatLngFromAddress(address);
                    setTimeout(function(){
                        submit();
                    }, 600); 
                }

                function submit(){    
                    document.minfo.action="post_point.php";
                    document.minfo.method="post";
                    document.minfo.enctype="multipart/form-data";
                    document.minfo.submit();    
                }            
            });
        });
        </script>
    </head>

    <body>
        <!--完了ページ・データpostページの指定--->
        <form name="minfo" >
        <div class="title">マーカー情報入力フォーム</div>
        <br>
            <table>
                <tr>
                    <th>吹き出しタイトル(30文字まで)</th>
                    <td><input type="text" name="title" maxlength='29' required="required" placeholder="入力必須項目"></td>
                </tr>
                <tr>
                    <th>内容（簡潔に）</th>
                    <td><textarea name="body" id="" cols="30" rows="10"></textarea></td>
                </tr>
                <tr>
                    <th>住所または名称</th>
                    <td><input id="address" name="address" type="text" required="required" placeholder="入力必須項目"></td>
                </tr>
                <tr>
                    <th>サムネイル(.jpgのみ対応)</th>
                    <td><input type="file" name="fname" accept="image/*"></td>
                </tr>
                <tr>
                    <!--緯度-->
                    <td><input id="latitude" type="hidden" name="lat" readonly></td>
                </tr>
                <tr>
                    <!--経度-->
                    <td><input id="longitude" type="hidden" name="lng" readonly></td>
                </tr>
            </table>
        </form>

        <button class="add_btn" type="button" id="search">登録</button>
        <button class="edit_link" type="button" onclick="location.href='edit_top.php'">データの編集/削除</button>
        <button class="home_link" type="button" onclick="location.href='admin_home.php'">ホーム</button>

        <?php

            require("DB/db_view.php");

        ?>
    
       
    </body>

</html>
