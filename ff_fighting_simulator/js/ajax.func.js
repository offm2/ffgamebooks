$(document).ready(function(){
	$('form').on('click','#go',function(e){
	e.preventDefault();
	var mstamina = $('#msta').val();
	var mskill = $('#msk').val();
	var mluck = $('#ml').val();
	var estamina = $('#esta').val();
	var eskill = $('#esk').val();
	//alert("teste");
	    $.ajax({
        url: 'data/1st_fight.php',
        type: 'POST',
        dataType: 'JSON',
		data:{mst:mstamina,msk:mskill,ml:mluck,est:estamina,esk:eskill},
        success: function(response){
				
                var mst = response["records"][0].mystamina;
                var msk = response["records"][0].myskill;
                var ml = response["records"][0].myluck;
				var est = response["records"][0].enstamina;
				var esk = response["records"][0].enskill;
				$('#msta').val(mst);
				$('#msk').val(msk);
				$('#ml').val(ml);
				$('#esta').val(est);
				$('#esk').val(esk);
                var md1 = response["records"][0].mdice1;
                var md2 = response["records"][0].mdice2;
                var ed1 = response["records"][0].endice1;
				var ed2 = response["records"][0].endice2;
				var dec = response["records"][0].decision;
                var tr_str = "<tr>" +
                    "<td>" + md1 + "</td>" +
                    "<td>" + md2 + "</td>" +
                    "<td>" + ed1 + "</td>" +
					"<td>" + ed2 + "</td>" +
					"<td>" + dec + "</td>" +
                    "</tr>";

                $(".tab1 tbody").append(tr_str);
				var msg = response["records"][0].message;
				var tr_str2 = "<tr>" +
                    "<td>" + msg + "</td>" +
                    "</tr>";

                $(".tab2 tbody").append(tr_str2);
				
        }
    }).done(function(data) {
		console.log(data);
	});
	});
	$('form').on('click','#go3',function(e){
	e.preventDefault();
	var mstamina = $('#msta').val();
	var mskill = $('#msk').val();
	var mluck = $('#ml').val();
	var estamina = $('#esta').val();
	var eskill = $('#esk').val();
	//alert("teste");
	    $.ajax({
        url: 'data/ct-fight.php',
        type: 'POST',
        dataType: 'JSON',
		data:{mst:mstamina,msk:mskill,ml:mluck,est:estamina,esk:eskill},
        success: function(response){
 
                var mst = response["records"][0].mystamina;
                var msk = response["records"][0].myskill;
                var ml = response["records"][0].myluck;
				var est = response["records"][0].enstamina;
				var esk = response["records"][0].enskill;
				$('#msta').val(mst);
				$('#msk').val(msk);
				$('#ml').val(ml);
				$('#esta').val(est);
				$('#esk').val(esk);
                var md1 = response["records"][0].mdice1;
                var md2 = response["records"][0].mdice2;
                var ed1 = response["records"][0].endice1;
				var ed2 = response["records"][0].endice2;
				var dec = response["records"][0].decision;
				var dec2 = response["records"][0].decision2;
                var tr_str = "<tr>" +
                    "<td>" + md1 + "</td>" +
                    "<td>" + md2 + "</td>" +
                    "<td>" + ed1 + "</td>" +
					"<td>" + ed2 + "</td>" +
					"<td>" + dec + "</td>" +
					"<td>" + dec2 + "</td>" +
                    "</tr>";

                $(".tab1 tbody").append(tr_str);
				var msg = response["records"][0].message;
				var tr_str2 = "<tr>" +
                    "<td>" + msg + "</td>" +
                    "</tr>";

                $(".tab2 tbody").append(tr_str2);
        }
    }).done(function(data) {
		console.log(data);
	});
	});
	$('form').on('click','#go2',function(e){
	e.preventDefault();
	var mstamina = $('#msta').val();
	var mskill = $('#msk').val();
	var mluck = $('#ml').val();
	var estamina = $('#esta').val();
	var eskill = $('#esk').val();
	//alert("teste");
	    $.ajax({
        url: 'data/using-luck.php',
        type: 'POST',
        dataType: 'JSON',
		data:{mst:mstamina,msk:mskill,ml:mluck,est:estamina,esk:eskill},
        success: function(response){
 
                var mst = response["records"][0].mystamina;
                var msk = response["records"][0].myskill;
                var ml = response["records"][0].myluck;
				var est = response["records"][0].enstamina;
				var esk = response["records"][0].enskill;
				$('#msta').val(mst);
				$('#msk').val(msk);
				$('#ml').val(ml);
				$('#esta').val(est);
				$('#esk').val(esk);
                var md1 = response["records"][0].mdice1;
                var md2 = response["records"][0].mdice2;
				var dec = response["records"][0].decision;
				var dec2 = response["records"][0].decision2;
                var tr_str = "<tr>" +
                    "<td>" + md1 + "</td>" +
                    "<td>" + md2 + "</td>" +
                    "<td></td>" +
					"<td></td>" +
					"<td>" + dec + "</td>" +
					"<td>" + dec2 + "</td>" +
                    "</tr>";

                $(".tab1 tbody").append(tr_str);
				var msg = response["records"][0].message;
				var tr_str2 = "<tr>" +
                    "<td>" + msg + "</td>" +
                    "</tr>";

                $(".tab2 tbody").append(tr_str2);
        }
    }).done(function(data) {
		console.log(data);
	});
	});
	$('form').on('click','#restart',function(e){
	e.preventDefault();
	location.reload();
	});

});
