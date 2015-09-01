(function( $ ) {
	
	function dodaj() {
		var select = $(".wrapper-select").eq(0).clone();
		
		var sel = $(".wrapper-select").eq(0).after(select);
		console.log(sel.find("select"))
		//sel.find("select").combobox();
	}
	
	$( document ).ready(function() {
		$('.glyphicon.glyphicon-plus').click(function(){
			dodaj();
		});
	});
}(jQuery));