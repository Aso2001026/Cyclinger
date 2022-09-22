var lat2
var lng2
var MvOs
var MarAN
var lines
var latlng
var s = 0
var cnt = 0
var flag = 0
var galf = 0
const R = 6371.0710
var se_pos = []

var mar_Lps = []
var mar_laN = []
var mar_pos = []
var mar_array = []

function initMap(){
    navigator.geolocation.getCurrentPosition(success, error)

    function success(position){
/*
        lat2 = position.coords.latitude
        lng2 = position.coords.longitude
        latlng = Cycling google.maps.LatLng(lat2,lng2)
*/
        laln = new google.maps.LatLng(la,ln)

        mar_laN.push(la,ln)

        const map = new google.maps.Map(document.getElementById('map'),{
            zoom: 15,
            center: laln,
            mapTypeId: "roadmap",
            mapTypeControl: false,
            streetViewControl: false,
            fullscreenControl: false
        })
        
            Main = new google.maps.Marker({
                position: laln,
                map: map
            })
        
       document.getElementById("del").style.visibility = "hidden"
       document.getElementById("view_array").style.display = "none"
/*       
       document.getElementById("p1").style.display = "none"
       document.getElementById("p2").style.display = "none"
*/
       /*main機能(残り距離計算、移動の線)*/
/*
       document.getElementById('Mv_On').addEventListener('click',function(){
        let LinM = []

        let lAm = position.coords.latitude
        let lNm = position.coords.longitude
        let laNm = Cycling google.maps.LatLng(lAm,lNm)

        MarAN = Cycling google.maps.Marker({
            position: laNm,
            map: map
        })

        if(!(mar_array.length)){
            console.log("設置してください!")

        }else{
            MvOs = setInterval(function(){
                lAm = position.coords.latitude
                lNm = position.coords.longitude
                laNm = Cycling google.maps.LatLng(lAm,lNm)

            LinM.push(laNm)

            lnDr = Cycling google.maps.Polyline({
                path: LinM,
                strokeColor: "#0000ff",
                strokeOpacity: .9,
                strokeWeight: 7
            })
            lnDr.setMap(map)
            MarAN.setMap(null)

            MarAN = Cycling google.maps.Marker({
                position: laNm,
                map: map
            })

            let total = 0
            let Km = 0
          
            let a = lAm
            let b = lNm
            let c = mar_laN[0]
            let d = mar_laN[1]
            let aKm=a*(Math.PI/180)
            let bKm=b*(Math.PI/180)
            let cKm=c*(Math.PI/180)
            let dKm=d*(Math.PI/180)
          
            total = (R * Math.acos(Math.cos(cKm)*Math.cos(aKm)*Math.cos(bKm-dKm)+Math.sin(cKm)*Math.sin(aKm)))
            Km = Km + total
            var TL = Math.floor(Km*100)/100
            if(TL <= 0.01){
                galf = 0
                p2.style.display = "block";
                p2.addEventListener('click',() =>{
                    if(galf === 0){
                    mar_array[0].setMap(null)
                    mar_array.splice(0,1)
                    mar_pos.splice(0,1)
                    if(mar_array.length === 0){
                        p2.style.display = "none"
                        document.getElementById('view_array').innerHTML = mar_pos.join('')
                        alert('Clear!')
                        clearInterval(MvOs)
                    }else{
                        alert("残り"+mar_array.length)
                        p2.style.display = "none"
                        document.getElementById('view_array').innerHTML = mar_pos.join('')
                    }
                    galf = 1
                    }
                })
            }else{
                document.getElementById('view_h').innerHTML = (TL+'km')
            }
                
            },10000)    
        }    
       })
*/
       /*markerの線を結ぶ処理*/
/*
       document.getElementById("Li_St").addEventListener('click',function(){
        if(flag == 1){
            lines.setMap(null)
            flag == 0
        }
            lines = Cycling google.maps.Polyline({
            path: mar_Lps,
            strokeColor: "#ff0000",
            strokeOpacity: .7,
            strokeWeight: 7
        })
            lines.setMap(map)
            flag = 1
        })
        /*線を消す処理*/
/*
       document.getElementById("Li_Dl").addEventListener('click',function(){
        for(let n = 0;n < mar_array.length;n++){
            lines.setMap(null)
        }
       })
       /*markerの線の距離を足す処理*/
/*
       document.getElementById("cal").addEventListener('click',function(){
        let sum = 0
        let lan = 0

        for(let m = 0;m < mar_laN.length-2;m=m+2){
            let x1 = mar_laN[m]
            let y1 = mar_laN[m+1]
            let x2 = mar_laN[m+2]
            let y2 = mar_laN[m+3]
            let x2k=x1*(Math.PI/180)
            let y2k=y1*(Math.PI/180)
            let x1k=x2*(Math.PI/180)
            let y1k=y2*(Math.PI/180)
        
            lan = (R * Math.acos(Math.cos(x1k)*Math.cos(x2k)*Math.cos(y2k-y1k)+Math.sin(x1k)*Math.sin(x2k)))   
            sum = sum + lan     
        }
        var s = Math.ceil(sum*100)/100
        console.log(mar_laN)
        if(s == 0){
            document.getElementById('view_dista').innerHTML = s + "km"

        }else{
            document.getElementById('view_dista').innerHTML = "約" + s + "km"
        }
       })
*/       
       /*検索機能*/

       google.maps.event.addListener(map,'click',event => clickListener(event,map))
/*
       const input = document.getElementById("pac-input")
       const searchBox = Cycling google.maps.places.SearchBox(input)
       map.controls[google.maps.ControlPosition.LEFT].push(input)

       map.addListener("bounds_changed",()=>{
        searchBox.setBounds(map.getBounds())    
       })
*/
       /*マップ検索時削除する処理*/
/*
       window.document.onkeydown = function(event){
        if((event.key === 'Enter')&&(input.value === "")){
            se_pos.forEach((marker)=>{
                marker.setMap(null)
                p1.style.display = "none";
            })
        }
       }

       searchBox.addListener("places_changed",()=>{
        const places = searchBox.getPlaces()

        if(places.length == 0){
            return
        }
        se_pos.forEach((marker)=>{
            marker.setMap(null)
        })
        se_pos = []

        const bounds = Cycling google.maps.LatLngBounds()
        places.forEach((place)=>{
            if(!place.geometry){
                console.log("Returned place contains no geometry")
                return
            }

            se_pos.push(
                Cycling google.maps.Marker({
                    position: place.geometry.location,
                    map: map
                })
            )


            p1.style.display = "block";
            

            if(place.geometry.viewport){
                bounds.union(place.geometry.viewport)
            }else{
                bounds.extend(place.geometry.location)
            }
        })
    
        map.fitBounds(bounds)
       })
*/
    }
    function error(){
        document.write("位置情報の取得に失敗しました。")
    }
}



/*押したときにmarkerを作る処理*/
function clickListener(event,map){
    const lat = event.latLng.lat()
    const lng = event.latLng.lng()
    mar_laN.push(lat,lng)

    if(cnt < 8){
        mar_pos.push('<input type="radio" id="ct"'+cnt+'+" name="array" value="ct'+cnt+'"><input type = "text" class = "checkName" name = "checkName" placeholder="'+(cnt+1)+'"><br>')
        document.getElementById('view_array').innerHTML = mar_pos.join('')
        cnt++    
    

    marker = new google.maps.Marker({
        position: {lat,lng},
        map: map
    })
    mar_array.push(marker)
    mar_Lps.push(marker.position)

    if(mar_array.length){
        del.style.visibility = "visible"
        view_array.style.display = "block"
    }

    /*計算処理*/
    let sum = 0
    let lan = 0

    for(let m = 0;m < mar_laN.length-2;m=m+2){
        let x1 = mar_laN[m]
        let y1 = mar_laN[m+1]
        let x2 = mar_laN[m+2]
        let y2 = mar_laN[m+3]
        let x2k=x1*(Math.PI/180)
        let y2k=y1*(Math.PI/180)
        let x1k=x2*(Math.PI/180)
        let y1k=y2*(Math.PI/180)
    
        lan = (R * Math.acos(Math.cos(x1k)*Math.cos(x2k)*Math.cos(y2k-y1k)+Math.sin(x1k)*Math.sin(x2k)))   
        sum = sum + lan     
    }
    s = Math.ceil(sum*100)/100
    if(s == 0){
        document.getElementById('view_dista').innerHTML = s + "km"

    }else{
        document.getElementById('view_dista').innerHTML = "約" + s + "km"
    }
}

}

/*選択した座標とmarkerを消す*/
function deleteMarkers(idx = null){
    var elm = document.getElementsByName("array")

    for(var a = "",i = mar_pos.length;i--;){
        if(elm[i].checked){
            mar_pos.splice(i,1)

            for(var j = 0;j < mar_array.length;j++){
                if(idx.indexOf(j) >= 0){
                    mar_array[i].setMap(null)
                    mar_array.splice(i,1)
                    mar_Lps.splice(i,1)
                    if(i == 0){
                        mar_laN.splice(i,2)
                    }else if((i+1)%3 == 0){
                        mar_laN.splice((i+2),2)
                    }else{
                        mar_laN.splice(i+1,2)
                    }
                }
            }
            document.getElementById('view_array').innerHTML = mar_pos.join('')
            cnt--
            break
        }
    }
    if(mar_array.length === 0){
        del.style.visibility = "hidden"
        view_array.style.display = "none"
        cnt = 0
    }
    if(mar_laN.length <= 2){
        document.getElementById('view_dista').innerHTML = "0km"    }
}
/*今日の日付*/
var date = new Date()
month = date.getMonth()+1
day = date.getDate()
document.getElementById("date").innerHTML = month + "月" + day + "日"

/*ページ更新処理*/
function Reload(){
    document.location.reload()
}