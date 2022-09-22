let mark_pos = []

function initMap() {
    navigator.geolocation.getCurrentPosition(success, error);

    function success(position) {

        var lat2 = position.coords.latitude;
        var lng2 = position.coords.longitude;
        var latlng = new google.maps.LatLng(lat2,lng2);

        document.getElementById("enter").style.display="none";
        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: latlng,
            mapTypeControl:false,
            streetViewControl:false,
            fullscreenControl:false
        });
        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);

        map.controls[google.maps.ControlPosition.LEFT].push(input);

        map.addListener("bounds_changed", () => {
            searchBox.setBounds(map.getBounds());
        });
        window.document.onkeydown = function(event){

            if((event.key === 'Enter')&&(input.value === "")){

                mark_pos.forEach((marker)=>{

                    marker.setMap(null)

                    enter.style.visibility = "hidden";

                })

            }

        }
        searchBox.addListener("places_changed",()=>{
            const places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            mark_pos.forEach((marker)=>{
                marker.setMap(null)
            })
            mark_pos = [];
            const bounds = new google.maps.LatLngBounds();
            places.forEach((place) => {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                mark_pos.push(
                    new google.maps.Marker({
                        map,
                        position: place.geometry.location,
                    })
                );
                enter.style.display="block";

                document.getElementById('lat').value = place.geometry.location.lat()
                document.getElementById('lng').value = place.geometry.location.lng()
                document.getElementById('placeName').value = input.value
    
                if(place.geometry.viewport){
                    bounds.union(place.geometry.viewport);
                }else{
                    bounds.extend(place.geometry.location);
                }
            })
            map.fitBounds(bounds);

        })
    }

    function error() {
        document.write("位置情報の取得に失敗しました。");
    }
}