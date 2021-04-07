const defaultLocation = [31.8164812, 54.3631571];
const defaultZoom = 15;
var map = L.map('map').setView(defaultLocation, defaultZoom);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 18,
    attribution: 'Map data &copy; <a href="#">OpenStreetMap</a> contributors, ' +
        'Amir Abouei',
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1
}).addTo(map);

document.getElementById('map').style.setProperty('height', window.innerHeight + 'px')


// L.marker(defaultLocation).addTo(map).bindPopup("ّFarhang 5 Complex Apartment").openPopup();
// L.marker([31.8219081, 54.3546353]).addTo(map).bindPopup("ّZoroastrians Towers of Silence");

map.on('dblclick', function(event) {
    // alert("Location added in " + event.latlng.lat + " , " + event.latlng.lng);
    L.marker([event.latlng.lat, event.latlng.lng]).addTo(map)
    $('.modal-overlay').fadeIn(500);
    $('#lat-display').val(event.latlng.lat);
    $('#lng-display').val(event.latlng.lng);

    $('#l-title').val('');
    $('#l-title').val('');

    $('#u-name').val('');
    $('#u-email').val('');

    $('.ajax-result').html('');
});


$(document).ready(function() {
    $('form#addLocationForm').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var resultTag = form.find('.ajax-result');
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
                resultTag.html(response);
            }
        });
    });


    $('.modal-overlay .close').click(function() {
        $('.modal-overlay').fadeOut();
    })
});

// // -- Find Recent Location -- //

// var current_position, current_accuracy;
// // find Current Location
// map.on('locationfound', function(e) {
//     // if position defined, then remove the existing position marker 
//     if (current_position) {
//         map.removeLayer(current_position);
//         map.removeLayer(current_accuracy);
//     }
//     var radius = e.current_accuracy;

//     current_position = L.marker(e.latlng).addTo(map).bindPopup("Your location is nearly" + radius + "meter").openPopup();
//     current_accuracy = L.circle(e.latlng, radius).addTo(map);
// });

// map.on('locationerror', function(e) {
//     console.log(e.message);
//     console.log(e.message);
// });

// wrap map.locate in a function
function locate() {
    map.locate({ setView: true, maxZoom: defaultZoom });
}

// // cal locate every 5 seconds... for ever
// setInterval(locate, 5000);