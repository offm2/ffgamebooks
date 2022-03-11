$(document).ready(function(){
$("#submitm").attr('disabled','disabled');
    var max = 3;
    var checkboxes = $('input[type="checkbox"]');
 
    checkboxes.change(function(){
	$("#submitm").attr('disabled','disabled');
        var current = checkboxes.filter(':checked').length;
        checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
		if (current==3){$("#submitm").removeAttr('disabled');}
    });
	
});
