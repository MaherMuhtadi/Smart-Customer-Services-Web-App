const KEY = "AIzaSyDJYCHEodV-BRyIe9tEt6VCIjq2E7L98qI"; //Google Maps API Key

async function initMap() {
    /**
     * generates the map and calculates the distance
     */
    var dst = await geocode(document.getElementById("destination").value);
    var map = new google.maps.Map(document.getElementById("map"), {zoom: 13, center: dst});
    var marker = new google.maps.Marker({position: dst, map: map});    
    var infoWindow = new google.maps.InfoWindow({content: "<span style='color:black'>You</span>"});
    marker.addListener("click", function() {infoWindow.open(map, marker);});

    var src = await geocode(document.getElementById("source").value);
    var marker2 = new google.maps.Marker({position: src, map: map});
    var infoWindow2 = new google.maps.InfoWindow({content: "<span style='color:black'>Warehouse</span>"});
    marker2.addListener("click", function() {infoWindow2.open(map, marker2);});

    getDistance(src, dst);
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

function getDistance(src, dst) {
    /**
     * takes the lat-lng values of source and destination
     * writes the distance data to HTML
     */
    var service = new google.maps.DistanceMatrixService();
    var matrixOptions = {
        origins: [src],
        destinations: [dst],
        travelMode: 'DRIVING',
        unitSystem: google.maps.UnitSystem.METRIC
    };

    service.getDistanceMatrix(matrixOptions, callback);

    // Callback function used to process Distance Matrix response
    function callback(response, status) {
        if (status !== "OK") {
            console.log("Error with distance matrix");
            return;
        }
        document.getElementById("info").innerHTML = "Distance: " + response.rows[0].elements[0].distance.text;
    }
}