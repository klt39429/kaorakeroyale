function vote(token_id, vote_choice, div_element) {
	
	$.ajax({
		type: 'POST',
  	url: 'http://localhost//htdocs/karaoke_contest/add_vote/' 
  			+ token_id + "/" + vote_choice,
  	dataType: 'text',
  	success: function( new_count ){
  				
  				div_element.html('Rating: ' + new_count);
  			},
  	error: function(){ alert( "failure" ); }
	});
	
}

$(function(){
	
	$('.thumb_up,.thumb_down').click(function(){
	var element = $(this);
	
	vote(element.attr('token_id'), element.attr('vote_choice'), element.parent());
	});
	
});                        

