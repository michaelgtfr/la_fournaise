import './styles/homepage.scss';
import $ from 'jquery';
const Marker = require( './Components/Marker');

$(document).ready( function (e) {

    let marker = new Marker();

    let day = new Date().getDay();

    let marker_number_total_call = 1;

    let leaflet = document.querySelector('#mapid');
    leaflet.setAttribute("data-number-marker-total-call", marker_number_total_call );

    let location = document.getElementById('day-'+day);

    let message = location.querySelector('.hour').textContent + location.querySelector('.address').textContent;


    marker.markerPoint(location.dataset.longitude, location.dataset.latitude, message);

    $(".card").click(function (e) {
        e.preventDefault();

        marker_number_total_call += 1;
        leaflet.setAttribute("data-number-marker-total-call",  marker_number_total_call);

        let longitude = $(this).data("longitude");
        let latitude = $(this).data("latitude");
        let message = $(this).find(".hour").text() + $(this).find(".address").text();

        $('.leaflet-marker-icon').remove();
        $('.leaflet-marker-shadow').remove();
        marker.markerPoint(longitude, latitude, message);
    });
});
