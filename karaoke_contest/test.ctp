<script src="http://staging.tokbox.com/v0.91/js/TB.min.js" type="text/javascript"></script>

<script type="text/javascript">
    var apiKey = '7170912';
    var sessionId = '14685d1ac5907f4a2814fed28294d3f797f34955';
    var token = 'devtoken';  
    
	var PUBLISHER_WIDTH = 150;
	var PUBLISHER_HEIGHT = 130;
	var SUBSCRIBER_WIDTH = PUBLISHER_WIDTH;
	var SUBSCRIBER_HEIGHT = PUBLISHER_HEIGHT;
	
	var participants = 0;
     
    TB.setLogLevel(TB.DEBUG);     
 
    var session = TB.initSession(sessionId);      
    session.addEventListener('sessionConnected', sessionConnectedHandler);
    session.addEventListener('streamCreated', streamCreatedHandler);      
    session.connect(apiKey, token);
 
    var publisher;
 
    function sessionConnectedHandler(event) {
 

      // Subscribe to streams that were in the session when we connected
      subscribeToStreams(event.streams);
      		
		if( participants < 4 )
		{
		
			// Starts publishing user local camera and mic
			// as a stream into the session
			
			participants++;
		
			// Create a div for the publisher to replace
			var parentDiv = document.getElementById("stream_" + (participants));
			var stubDiv = document.createElement("div");
			stubDiv.id = "opentok_publisher";
			parentDiv.innerHTML = "";
			parentDiv.appendChild(stubDiv);
			
			publisher = session.publish(stubDiv.id, {width: PUBLISHER_WIDTH, height: PUBLISHER_HEIGHT});
       	}
      
      
    }
     
    function streamCreatedHandler(event) {
      // Subscribe to any new streams that are created
      subscribeToStreams(event.streams);
    }
     
    function subscribeToStreams(streams) {
      for (var i = 0; i < streams.length; i++) {
        // Check that connectionId on the stream to make sure we don't subscribe to ourself
        if (streams[i].connection.connectionId == session.connection.connectionId) {
          return;
        }
             
        participants++;     
        
		// Create a div for the subscriber to replace
		// Assumes that streamIds are integers; true for basic streams
		var parentDiv = document.getElementById("stream_" + (i+2));
		var stubDiv = document.createElement("div");
		stubDiv.id = "opentok_subscriber_" + streams[i].streamId;
		parentDiv.innerHTML = "";
		parentDiv.appendChild(stubDiv);
		

	
		session.subscribe(streams[i], stubDiv.id, {width: SUBSCRIBER_WIDTH, height: SUBSCRIBER_HEIGHT});
		      
         
         
      }
    }   
</script>


<script type="text/javascript">

	
	function vote(element, id, vote_choice) {

		
		$.ajax({
			type: 'POST',
		  	url: 'http://localhost/karaoke_app/karaoke_contest/add_vote/' 
		  			+ id + "/" + vote_choice,
		  	dataType: 'text',
		  	success: function( msg ){
		  				element.html("<span>" + msg + "</span>"); 
		  	},
		  	error: function(){ alert( "failure" ); }
		});
		
	}
	
	$(function(){
			
		$('.thumb_up,.thumb_down').click(function(){
			var element = $(this);
			
			vote(element, element.attr('user_id'), element.attr('vote_choice'));
		});
		
	});                        

</script>


<div>
	
<?php
	for ($i=1; $i<=4; $i++) { 
		echo $this->Player->getPlayer($i);
	} 
?>

	
</div>