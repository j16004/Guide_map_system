var map;
var markerData = [];
var marker = [];
var infoWindow = [];

var obj;

function initMap() {

  /*==========マークポイント==========*/
  (function (handleload) {
    var xhr = new XMLHttpRequest;
    
    xhr.addEventListener('load', handleload, false);
    //.jsonファイルのファイル名を指定
    xhr.open('GET', 'data.json', true);
    xhr.send(null);

    }
  
    (function handleLoad (event) {
        var xhr = event.target,
        objdata = JSON.parse(xhr.responseText);

        //配列の数を取得
        length = objdata.length;
        console.log("jsonデータ数:"+length);

        for(var i=0; i<length; i++){

          //--------------テキストデータをfloatに変換---------------
          objdata[i].id = parseFloat(objdata[i].id);
          objdata[i].lat = parseFloat(objdata[i].lat);
          objdata[i].lng = parseFloat(objdata[i].lng);
                
        }

        //緯度経度の取得をここで行う（住所をDBに保存して取得）
        // 地図の作成
        // 緯度経度のデータ作成
        var mapLatLng = new google.maps.LatLng({lat: objdata[0]['lat'], lng: objdata[0]['lng']}); 
        // #sampleに地図を埋め込む
        map = new google.maps.Map(document.getElementById('maps'), { 
          // 地図の中心を指定
          center: mapLatLng, 
          // 地図のズームを指定
          zoom: 12 
        });

        
        // マーカー毎の処理
        for (var j = 0; j < length; j++) {
          // 緯度経度のデータ作成
          markerLatLng = new google.maps.LatLng({lat: objdata[j].lat, lng: objdata[j].lng}); 
          // マーカーの追加
          marker[j] = new google.maps.Marker({ 
            // マーカーを立てる位置を指定
            position: markerLatLng,
            // マーカーを立てる地図を指定
            map: map 
          });

          // 吹き出しの追加
          infoWindow[j] = new google.maps.InfoWindow({
            content:
          '<div class="sample">' + objdata[j]['title'] + '<br/>' +
          '<img src=upimg/'+objdata[j]['img']+' width="120" height="120">' + '<br />'+
          objdata[j]['body'] +
          '</div>'

          });

          // マーカーにクリックイベントを追加
        markerEvent(j); 
        }
    })
  );

   /*==========経路案内==========*/

   
  (function(handleload){

    var xhr = new XMLHttpRequest;
    
    xhr.addEventListener('load', handleload, false);
    //.jsonファイルのファイル名を指定
    xhr.open('GET', 'route.json', true);
    xhr.send(null);
    }
  
    (function handleLoad (event) {
      var xhr = event.target,
      
      routedata = JSON.parse(xhr.responseText);
        //配列の数を取得
        rlength = routedata.length;
        console.log("ルートデータ数:"+rlength);

        routedata[rlength-1].id = parseInt(routedata[rlength-1].id);
        //スタート地点
        routedata[rlength-1].lat1 = parseFloat(routedata[rlength-1].lat1);
        routedata[rlength-1].lng1 = parseFloat(routedata[rlength-1].lng1);
        //ゴール地点
        routedata[rlength-1].lat2 = parseFloat(routedata[rlength-1].lat2);
        routedata[rlength-1].lng2 = parseFloat(routedata[rlength-1].lng2);
        //以下経由地1~4の緯度経度
        routedata[rlength-1].lat3 = parseFloat(routedata[rlength-1].lat3);
        routedata[rlength-1].lng3 = parseFloat(routedata[rlength-1].lng3);

        routedata[rlength-1].lat4 = parseFloat(routedata[rlength-1].lat4);
        routedata[rlength-1].lng4 = parseFloat(routedata[rlength-1].lng4);

        routedata[rlength-1].lat5 = parseFloat(routedata[rlength-1].lat5);
        routedata[rlength-1].lng5 = parseFloat(routedata[rlength-1].lng5);

        routedata[rlength-1].lat6 = parseFloat(routedata[rlength-1].lat6);
        routedata[rlength-1].lng6 = parseFloat(routedata[rlength-1].lng6);

      //}
      
      /*ルート処理*/
      var directionsService = new google.maps.DirectionsService;
      var directionsRenderer = new google.maps.DirectionsRenderer;

      var rstart = routedata[rlength-1].lat1 +','+routedata[rlength-1].lng1
      var rgoal = routedata[rlength-1].lat2+','+routedata[rlength-1].lng2; 

      // ルート検索を実行
      directionsService.route({
        //スタート地点とゴール地点
        origin: rstart,
        destination: rgoal,
        // 経由地点（入力枠を用意した場合、その数を満たさなければならない）
        waypoints: [ 
        { location: new google.maps.LatLng(routedata[rlength-1].lat3, routedata[rlength-1].lng3) ,stopover:false},
        { location: new google.maps.LatLng(routedata[rlength-1].lat4, routedata[rlength-1].lng4) ,stopover:false},
        { location: new google.maps.LatLng(routedata[rlength-1].lat5, routedata[rlength-1].lng5) ,stopover:false},
        { location: new google.maps.LatLng(routedata[rlength-1].lat6, routedata[rlength-1].lng6) ,stopover:false}
        ],
        travelMode: google.maps.DirectionsTravelMode.WALKING, // 交通手段(歩行。DRIVINGの場合は車)
      },

      function(response, status) {
        console.log(response);
        if (status === google.maps.DirectionsStatus.OK) {
          // ルート検索の結果を地図上に描画
          directionsRenderer.setMap(map);
          directionsRenderer.setDirections(response);
        }
      });

    })
  );
   
}

// マーカーにクリックイベントを追加
function markerEvent(j) {
  // マーカーをクリックしたとき
  marker[j].addListener('click', function() { 
    // 吹き出しの表示
    infoWindow[j].open(map, marker[j]); 
  });
}
