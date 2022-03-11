<script>
$(document).ready(function()
{
    $("#s1").click(function()
    {
        $.ajax(
        {
            type: "GET",
            url: 'index2.php',
            data: {sound: 1},
            success: function(result)
            {
                var div = $("<div>").html(result);
				var section=$("#snd",div.get(0));
				$("#sound").html(section);
            }			
        });
    });
	});
</script>
<?php
if(ctype_digit($_GET["sound"])&&$_GET["sound"]==1){
echo"<h4>Music for the adventures</h4><iframe id='snd' width='240' height='135' src='//www.youtube.com/embed/lovYZqGVPBQ?rel=0&amp;showinfo=0&amp;autoplay=1' frameborder='0'></iframe>";
}
?>
<div id="sound"></div>
