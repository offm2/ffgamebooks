
$(document).ready(function() {
	$( "#start" ).click(function() {
var text = $("#sayt").text();
$("#saying").append(text);
var p = $("#saying").hide();
(function oneParagraph(i) {
    if (p.length <= i)
        return;
    var cur = p.eq(i),
        words = cur.html().split(/\s/),
        span = $("<span>"),
        before = document.createTextNode("");
    cur.empty().show().append(before, span);
    (function oneWord(j) {
        if (j < words.length) {
            span.hide().html(words[j]).fadeIn(300, function() {
                span.empty();
                before.data += words[j]+" ";
                oneWord(j+1);
            });
        } else {
            span.remove();
            before.data = words.join(" ");
            setTimeout(function(){
                oneParagraph(i+1);
            }, 400);
        }
    })(0);
})(0);
});
});
