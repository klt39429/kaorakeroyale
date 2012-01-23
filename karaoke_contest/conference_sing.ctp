<script src="http://staging.tokbox.com/v0.91/js/TB.min.js" type="text/javascript"></script>


<script type="text/javascript">
    var apiKey = '7170912';
    var sessionId = '<?=$song['session']?>';
    var token = 'devtoken';  
    
	var PUBLISHER_WIDTH = 275;
	var PUBLISHER_HEIGHT = 200;
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
        /*if (streams[i].connection.connectionId == session.connection.connectionId) {
          return;
        }*/
             
        participants++;     
        
		// Create a div for the subscriber to replace
		// Assumes that streamIds are integers; true for basic streams
		var parentDiv = document.getElementById("stream_" + (i));
		var stubDiv = document.createElement("div");
		stubDiv.id = "opentok_subscriber_" + streams[i].streamId;
		parentDiv.innerHTML = "";
		parentDiv.appendChild(stubDiv);
		

	
		session.subscribe(streams[i], stubDiv.id, {width: SUBSCRIBER_WIDTH, height: SUBSCRIBER_HEIGHT});
		      
         
         
      }
    }   
</script>



<script type="text/javascript">

	
	function vote(id, vote_choice) {

		
		$.ajax({
			type: 'POST',
		  	url: 'http://localhost/karaoke_app/karaoke_contest/add_vote/' 
		  			+ id + "/" + vote_choice,
		  	dataType: 'text',
		  	success: function(){alert("success");},
		  	error: function(){ alert( "failure" ); }
		});
		
	}
	
	$(function(){
			
		$('.thumb_up,.thumb_down').click(function(){
			var element = $(this);
			
			vote(element.attr('user_id'), element.attr('vote_choice'));
		});
		
	});                        

</script>

<div>

	<br />
	<br />
	<br />
	
		<h1>Karaoke Royal</h1>

		<div class="section">
		<?=$song['band']?> - <?=$song['name']?>
		</div>

		<div class="stream" id="stream_1">
			<?=$this->Html->image('profile-photo.jpg', array('alt' => 'CakePHP'))?> 
		</div>		
		<div class="stream" id="stream_2">
			<?=$this->Html->image('profile-photo.jpg', array('alt' => 'CakePHP'))?> 
		</div>
		<div class="stream" id="stream_3">
			<?=$this->Html->image('profile-photo.jpg', array('alt' => 'CakePHP'))?> 
		</div>
		<div class="stream" id="stream_4">
			<?=$this->Html->image('profile-photo.jpg', array('alt' => 'CakePHP'))?> 
		</div>

		<div class="clear"></div>
			

		<br><br><br>		
		
		<embed src="<?=$html->webroot('mp3/'.$song['mp3']); ?>" width="300" height="42" AUTOSTART="false"  ></embed>
		
	<br />
	<br />
	<br />

	
	<?php 
	
		echo $this->Html->image('thumb_up.gif',
				array('class' => 'thumb_up', 'user_id' => 1, 
						'vote_choice'=>'up', 'alt' => 'Vote Up'));
	 
	 
	?>
	<?php 
		echo $this->Html->image('thumb_down.gif',
				array('class' => 'thumb_down', 'user_id' => 1, 
						'vote_choice'=>'down', 'alt' => 'Vote Down')); 
	?>

</div>