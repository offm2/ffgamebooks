$(document).ready(function() {
var random = Math.floor(Math.random() * $('.randomitem').length);
$('.randomitem').hide().eq(random).show();
});