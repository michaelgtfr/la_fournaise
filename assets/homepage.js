import './styles/homepage.scss';
import $ from 'jquery';
const Marker = require( './Components/Marker');

$(document).ready( function () {
    let marker = new Marker();

    let day = new Date().getDay();

    let location = document.getElementById('day-'+day);

    let message = location.querySelector('.hour').textContent + location.querySelector('.address').textContent;

    marker.markerPoint(location.dataset.longitude, location.dataset.latitude, message);

    $(".card").click(function () {
        let longitude = $(this).data("longitude");
        let latitude = $(this).data("latitude");
        let message = $(this).find(".hour").text() + $(this).find(".address").text();

        $('.leaflet-marker-icon').remove();
        $('.leaflet-marker-shadow').remove();
        marker.markerPoint(longitude, latitude, message);
    });
});
