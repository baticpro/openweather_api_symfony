$(document).ready(() => {
   $('#my-location').click(() => {
       navigator.geolocation.getCurrentPosition(position => {
           location.href = '/?coords=' + position.coords.latitude + ',' + position.coords.longitude;
       })
   });
});