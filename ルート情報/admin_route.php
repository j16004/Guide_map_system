<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ルート情報入力フォーム|管理者</title>
        <!--CSSの読み込み-->

        <link rel="stylesheet" type="text/css" href="admin.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=KEY"></script>
        <script type="text/javascript">

        /* ========================================================================
        Attribute Latitude And Longitude From Address With Google Maps API
        ========================================================================== */
        $(function(){
            var len;
            var i;

            function attrLatLngFromAddress(address){
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({'address': address}, function(results, status){
                    if(status == google.maps.GeocoderStatus.OK) {
                        var lat = results[0].geometry.location.lat();
                        var lng = results[0].geometry.location.lng();
                        // 小数点第六位以下を四捨五入した値を緯度経度にセット、小数点以下の値が第六位に満たない場合は0埋め
                        document.getElementById("latitude"+i).value = (Math.round(lat * 1000000) / 1000000).toFixed(6);
                        document.getElementById("longitude"+i).value = (Math.round(lng * 1000000) / 1000000).toFixed(6);
                    }
                });           
            }

            $('#search').click(function(){
                len= 6;
                i=1;

                loop();

                function loop(){
                    if(i<=len){
                        var address = document.getElementById("address"+i).value;
                        
                        attrLatLngFromAddress(address);
                        
                        setTimeout(function(){
                            if(i==len){
                                submit();
                            }
                            i=i+1;
                            loop();
                        }, 600);
                    }
                    
                }

                function submit(){
                    if(i==len){
                        document.addresspost.action="post_route.php";
	                    document.addresspost.method="post";
	                    document.addresspost.submit();
                        
                    }else{
                        //
                    }
                }            

            });

        });
        </script>
    </head>

    <body>
        <!--完了ページ・データpostページの指定-->
        <form name="addresspost">
        <div class="title">ルート情報入力フォーム</div>
        <br>
        <td>ルートに登録したい場所の住所または名称を入力してください。</td>
        <br>
            <table>
                <tr>
                    <th>スタート地点</th>
                        <td><input id="address1" name="address1" type="text" class="inbox"></td>
                        <!--それぞれ（経由地１～４）に対応した住所を代入する処理を作る必要がある-->
                        <td><input id="latitude1" type="hidden" name="lat1" required readonly></td>
                        <td><input id="longitude1" type="hidden" name="lng1" required readonly></td>
                        
                </tr>
                <tr>
                    <th>ゴール地点</th>
                        <td><input id="address2" name="address2" type="text" class="inbox"></td>
                        <td><input id="latitude2" type="hidden" name="lat2" required readonly></td>
                        <td><input id="longitude2" type="hidden" name="lng2" required readonly></td>                        
                        
                </tr>
                <tr>
                    <th>経由地1</th>
                        <td><input id="address3" name="address3" type="text" class="inbox"></td>
                        <td><input id="latitude3" type="hidden" name="lat3" required readonly></td>
                        <td><input id="longitude3" type="hidden" name="lng3" required readonly></td>
                </tr>
                <tr>
                    <th>経由地2</th>
                        <td><input id="address4" name="address4" type="text" class="inbox"></td>
                        <td><input id="latitude4" type="hidden" name="lat4" required readonly></td>
                        <td><input id="longitude4" type="hidden" name="lng4" required readonly></td>      
                </tr>
                <tr>
                    <th>経由地3</th>
                        <td><input id="address5" name="address5" type="text" class="inbox"></td>
                        <td><input id="latitude5" type="hidden" name="lat5" required readonly></td>
                        <td><input id="longitude5" type="hidden" name="lng5" required readonly></td>                       
                        
                </tr>
                <tr>
                    <th>経由地4</th>
                        <td><input id="address6" name="address6" type="text" class="inbox"></td>
                        <td><input id="latitude6" type="hidden" name="lat6" required readonly></td>
                        <td><input id="longitude6" type="hidden" name="lng6" required readonly></td>                       
                    
                </tr>
            </table>
            </div>
            <br>
            <br>
        </form>
        <button class="add_btn" type="button" id="search">登録</button>
        <button class="home_link" type="button" onclick="location.href='admin_home.php'">ホーム</button>
    </body>

</html>

