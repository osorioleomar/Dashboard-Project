$(document).ready(function(){
	$(".choose").click(function(){
		var selected = $(this).parents().eq(1).html();
		var info = selected.replace("fa-arrow-right","fa-trash-o");

		//console.log(info);
		$("#choosen-list").append("<tr>" + info + "</tr>");
	});

	$("#select_all").click(function(){
		if($('#select_all').is(':checked')){
			var selected = $(this).parents().eq(2).html();
			var info = selected.replace("fa-arrow-right","fa-trash-o");
			$("#choosen-list").html(info);
		}else{
			alert("unchecked");
		}
	})
})