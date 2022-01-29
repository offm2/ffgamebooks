$(document).ready(function() {
var str = $('#sayt').html(),
    i = 0,
    isTag,
    text;
$( "#start" ).click(function start() {
  $("#sayt").hide();
  $("#sayt1").show();
 text = str.slice(0, ++i);
    if (text === str) return;

    document.getElementById('sayt1').innerHTML = text;

    var char = text.slice(-1);
    if( char === '<' ) isTag = true;
    if( char === '>' ) isTag = false;

    if (isTag) return start();
    clear=setTimeout(start, 75);
});

$( "#stop" ).click(function() {
  $("#sayt").show();
  $("#sayt1").hide();
 clearInterval(clear);
});
});

