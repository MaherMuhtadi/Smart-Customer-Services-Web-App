const KEY = "AIzaSyDJYCHEodV-BRyIe9tEt6VCIjq2E7L98qI"; // Google Maps API Key

var distance = 0;
var fee = 0;

async function initMap() {
    /**
     * Generates the map with route and calculates the distance
     */
    var src = document.getElementById("source").value;
    var dst = document.getElementById("destination").value;
    
    // Creates the map with destination geocode
    var dst_geocode = await geocode(dst);
    var map = new google.maps.Map(document.getElementById("map"), {zoom: 15, center: dst_geocode});

    // Generates directions
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();
    directionsRenderer.setMap(map);
    calculateAndDisplayRoute(directionsService, directionsRenderer, src, dst);

    getDistance(src, dst); // Calculates distance
}

async function geocode(address) {
    /**
     * Takes the string address returns the lat-lng object
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

function calculateAndDisplayRoute(directionsService, directionsRenderer, src, dst) {
    /**
     * Takes the directions service and renderer objects, the source and destination strings
     * and generates the route
     */
    directionsService.route({
        origin: {
            query: src,
        },
        destination: {
          query: dst,
        },
        travelMode: google.maps.TravelMode.DRIVING,
    })
    .then((response) => {
        directionsRenderer.setDirections(response);
    })
    .catch((e) => console.log("Directions request failed due to " + e));
}

function getDistance(src, dst) {
    /**
     * Takes the lat-lng values of source and destination writes the distance data to HTML
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
        distance = parseFloat(response.rows[0].elements[0].distance.text.split(" ")[0]);
        fee = (0.75*response.rows[0].elements[0].distance.value*0.001).toFixed(2);
        document.getElementById("info").innerHTML = 
            "Distance: " + distance + " km<br>"
            +"Delivery fee: " + fee + " CAD";
    }
}