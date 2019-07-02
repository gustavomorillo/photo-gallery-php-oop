
$(document).ready(function(){





$(".modal_thumbnails").click(function(){

$("#set_user_image").prop('disabled', false);

user_id = $(".user_id").prop('id');

	
photo_id = $(this).attr("data");

image_name = $(this).prop('id');

$.ajax({

url: "includes/ajax_code.php",
data: {photo_id:photo_id},
type: "POST",
success:function(data){
	if(!data.error){
		$("#modal_sidebar").html(data);
	}
}


})



});

$("#set_user_image").click(function(){

	$.ajax({

		url: "includes/ajax_code.php",
		data:{image_name: image_name, user_id: user_id},
		type: "POST",
		success:function(data){

			if(!data.error){

				location.reload(true);

			}
		}
	});


});



$(".info-box-header").click(function(){


$(".inside").slideToggle("fast");

$("#toggle").toggleClass("glyphicon-menu-down glyphicon , glyphicon-menu-up glyphicon");

});

$(".delete_button").click(function(){

return confirm("Are you sure you want to delete this item?");
window.location.replace("photos.php");


});
});