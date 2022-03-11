var interval;
$(window).on('show.bs.modal', function() {
	var text = $("#sayt").text();
			processString(text); 
});
function processString(t){
	var arr = t.match(/\S+/gi);
	var i=0;
	var wpm=140;
	//var wpm = $("#speed").val();
	if(isNaN(wpm) || wpm==""){
		wpm=140;
	}
	var useSpeed = 60000/wpm;
	
	interval=setInterval(function() {
	      // Do something every x seconds
	      $("#saying").text(arr[i]);
	      i++;
	}, useSpeed);
} 
$("#myModal").on("hidden.bs.modal", function () {
    // put your default event here
	clearInterval(interval);
});