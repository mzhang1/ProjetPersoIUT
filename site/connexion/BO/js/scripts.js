$(document).ready(function() {
  $('[data-toggle=offcanvas]').click(function() {
	$('.row-offcanvas').toggleClass('active');
  });
  
  $('.addUserButton').click(function(){
	  window.location.href = "ajout_user.php";
  });
  
  $('.deleteUser').click(function(event){
	  event.preventDefault();
	  var id = event.currentTarget.parentElement.parentElement.classList[0];
	  window.location.href = "administration.php?deleteId="+id+"";
  });
  
  $(".suspendUser").click(function(event){
	event.preventDefault();
	  var id = event.currentTarget.parentElement.parentElement.classList[0];
	  window.location.href = "administration.php?suspendId="+id+"";
  });
});