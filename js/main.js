$(document).ready(function(){
//for all carousels delay of interval
	$('carousel').carousel({
		interval:8000
	});

//collapse function in Team page
	//on 1st thumbnail
	$("#detail1").on("hide.bs.collapse",function(){
		$("#butt1").html('Open <span class="icon fa fa-chevron-up"><span/>');
	});
	$("#detail1").on("show.bs.collapse",function(){
		$("#butt1").html('Close <span class="icon fa fa-chevron-down"></span>');
	});

	//on 2nd thumbnail
	$("#detail2").on("hide.bs.collapse",function(){
		$("#butt2").html('Open <span class="icon fa fa-chevron-up"><span/>');
	});
	$("#detail2").on("show.bs.collapse",function(){
		$("#butt2").html('Close <span class="icon fa fa-chevron-down"></span>');
	});

	//on 3rd thumbnail
	$("#detail3").on("hide.bs.collapse",function(){
		$("#butt3").html('Open <span class="icon fa fa-chevron-up"><span/>');
	});
	$("#detail3").on("show.bs.collapse",function(){
		$("#butt3").html('Close <span class="icon fa fa-chevron-down"></span>');
	});

	//on 4th thumbnail
	$("#detail4").on("hide.bs.collapse",function(){
		$("#butt4").html('Open <span class="icon fa fa-chevron-up"><span/>');
	});
	$("#detail4").on("show.bs.collapse",function(){
		$("#butt4").html('Close <span class="icon fa fa-chevron-down"></span>');
	});

	//for fade effect on thumbnail when button hovered

	//on 1st thumbnail 
	$("#butt1").on("mouseover",
		function(){
			$("#mate1").fadeTo('slow',0.5);
	});

	$("#butt1").on("mouseleave",
		function(){
			$("#mate1").fadeTo('fast',1);
		});

	//on 2nd thumbnail
	$("#butt2").on("mouseover",
		function(){
			$("#mate2").fadeTo('slow',0.5);
	});

	$("#butt2").on("mouseleave",
		function(){
			$("#mate2").fadeTo('fast',1);
		});
	//on 3rd thumbnail
	$("#butt3").on("mouseover",
		function(){
			$("#mate3").fadeTo('slow',0.5);
	});

	$("#butt3").on("mouseleave",
		function(){
			$("#mate3").fadeTo('fast',1);
		});

	//on 4th thumbnail
	$("#butt4").on("mouseover",
		function(){
			$("#mate4").fadeTo('slow',0.5);
	});

	$("#butt4").on("mouseleave",
		function(){
			$("#mate4").fadeTo('fast',1);
		});
	
});