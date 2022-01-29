			$(document).ready(function() {
				$("#fastread").click(function(){
					$("#sayt").fastreader(
    {
        color: "brown",
        useFontAwesome: true,
        autoplay: true,
        readyText: "Fast read started!",
        wpm: 140
    }
);
				});
			});