// Leaflet settings
var mapLayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiYXVyZWxpZW0wNyIsImEiOiJja3M2M2NrcXUybHEwMnZtcnRxdXVmdnYzIn0.P1dTO3lMRr8c65_Gyf0-cg'
});

window.addEventListener("DOMContentLoaded", (event) => {

    var startingpoint = document.getElementById('mapid').dataset.startingpoint;

    var map = L.map('mapid');

    mapLayer.addTo(map);

    // Getting coordinates from OpenStreetMap API based on Stroll Starting Point
    fetch('https://nominatim.openstreetmap.org/search?q=' + startingpoint + '&format=json', {
            mode: 'cors'
        })
        .then(function (response) {
            if (response.ok) {
                response.json().then(function (json) {
                    let coordinate = json[0];
                    // Apply coordinates on map element
                    map.setView([coordinate.lat, coordinate.lon], 13);
                    L.marker([coordinate.lat, coordinate.lon]).addTo(map);
                });
            }
        });
});
