$(document).ready(function(){
	$(".sidebar-toggle").click(function(e){
		e.preventDefault();
		$("#wrapper").addClass('sidebar-show');

		$(".sidebar-close").click(function(){
			$("#wrapper").removeClass('sidebar-show');
		});
	});
});