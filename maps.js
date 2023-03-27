const KEY = "AIzaSyDJYCHEodV-BRyIe9tEt6VCIjq2E7L98qI"; //Google Maps API Key

async function initMap() {
    /**
     * generates the map
     */
    var dst = await geocode(document.getElementById("destination").value);
    var map = new google.maps.Map(document.getElementById("map"), {zoom: 14, center: dst});
    var marker = new google.maps.Marker({position: dst, map: map});    
    var infoWindow = new google.maps.InfoWindow({content: "<span style='color:black'>You</span>"});
    marker.addListener("click", function() {infoWindow.open(map, marker);});

    var src = await geocode(document.getElementById("source").value);
    var marker2 = new google.maps.Marker({position: src, map: map});
    var infoWindow2 = new google.maps.InfoWindow({content: "<span style='color:black'>Warehouse</span>"});
    marker2.addListener("click", function() {infoWindow2.open(map, marker2);});
}

async function geocode(address) {
    /**
     * takes the string address
     * returns the lat-lng object
     */
    var latlng;
    await fetch(`https://maps.googleapis.com/maps/api/geocode/json?address=${address}&key=${KEY}`)
    .then((response) => response.json())
    .then(jsonData => {
        latlng = jsonData.results[0].geometry.location;
    })
    .catch(error => {
        console.log(error);
    })
    return latlng;
}