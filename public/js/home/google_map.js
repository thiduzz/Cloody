/* ============================================================
 * Google Map
 * Render maps using Google Maps JS API
 * For DEMO purposes only. Extract what you need.
 * ============================================================ */

var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('google-map'), {
        center: new google.maps.LatLng(40.670000, -73.940000), // New York
        zoom: 11,
        disableDefaultUI: true,
        styles: [{
        featureType: 'water',
        elementType: 'all',
        stylers: [{
            hue: '#e9ebed'
        }, {
            saturation: -78
        }, {
            lightness: 67
        }, {
            visibility: 'simplified'
        }]
    }, {
        featureType: 'landscape',
        elementType: 'all',
        stylers: [{
            hue: '#ffffff'
        }, {
            saturation: -100
        }, {
            lightness: 100
        }, {
            visibility: 'simplified'
        }]
    }, {
        featureType: 'road',
        elementType: 'geometry',
        stylers: [{
            hue: '#bbc0c4'
        }, {
            saturation: -93
        }, {
            lightness: 31
        }, {
            visibility: 'simplified'
        }]
    }, {
        featureType: 'poi',
        elementType: 'all',
        stylers: [{
            hue: '#ffffff'
        }, {
            saturation: -100
        }, {
            lightness: 100
        }, {
            visibility: 'off'
        }]
    }, {
        featureType: 'road.local',
        elementType: 'geometry',
        stylers: [{
            hue: '#e9ebed'
        }, {
            saturation: -90
        }, {
            lightness: -8
        }, {
            visibility: 'simplified'
        }]
    }, {
        featureType: 'transit',
        elementType: 'all',
        stylers: [{
            hue: '#e9ebed'
        }, {
            saturation: 10
        }, {
            lightness: 69
        }, {
            visibility: 'on'
        }]
    }, {
        featureType: 'administrative.locality',
        elementType: 'all',
        stylers: [{
            hue: '#2c2e33'
        }, {
            saturation: 7
        }, {
            lightness: 19
        }, {
            visibility: 'on'
        }]
    }, {
        featureType: 'road',
        elementType: 'labels',
        stylers: [{
            hue: '#bbc0c4'
        }, {
            saturation: -93
        }, {
            lightness: 31
        }, {
            visibility: 'on'
        }]
    }, {
        featureType: 'road.arterial',
        elementType: 'labels',
        stylers: [{
            hue: '#bbc0c4'
        }, {
            saturation: -93
        }, {
            lightness: -2
        }, {
            visibility: 'simplified'
        }]
    }]
    });
}
