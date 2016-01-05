$(document).ready(function(){
	setInterval(function(){checkEveryGifs();},750);
});

function checkEveryGifs() {
		$(".reaction-gif").each(function(){
		var gif_id = $(this).attr("id");
		var current_src = $(this).attr("src");
		if(current_src == "static/preloader.gif"){
				$.post( "ajax.php", { gifname: gif_id })
					  .done(function( data ) {
					  	console.log(gif_id+" is "+data);
					     if(data != "NOT READY") {
					     	$("#"+gif_id).attr("src",data);
					     } 
					  });
		}
	});
}