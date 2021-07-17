//class allowing of use Leaflet

class Marker{

    constructor() {
        this.mymap = L.map('mapid').setView([50.712, 1.5833], 11);
    }

    markerPoint(longitudePoint,latitudePoint, messagePoint) {

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWljaGFlbGd0ZnIiLCJhIjoiY2tyMmRpcHFvMGo4bDJucnhjeXIybjJjdSJ9.bZVCosfBfkvVgJ9K54o9Dg'
        }).addTo(this.mymap);

        let marker = L.marker([latitudePoint, longitudePoint]).addTo(this.mymap);

        marker.bindPopup(messagePoint);
    }
}
module.exports = Marker;
