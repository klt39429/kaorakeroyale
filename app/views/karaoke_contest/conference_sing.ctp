<script src="http://staging.tokbox.com/v0.91/js/TB.min.js" type="text/javascript"></script>


<script type="text/javascript">
    var apiKey = '7170912';
    var sessionId = '<?=$song['session']?>';
    var token = '<?=$token?>';  
    
	var PUBLISHER_WIDTH = 275;
	var PUBLISHER_HEIGHT = 180;
	var SUBSCRIBER_WIDTH = PUBLISHER_WIDTH;
	var SUBSCRIBER_HEIGHT = PUBLISHER_HEIGHT;
	
	var participants = 0;
     
    //TB.setLogLevel(TB.DEBUG);     
 
    var session = TB.initSession(sessionId);      
    session.addEventListener('sessionConnected', sessionConnectedHandler);
    session.addEventListener('streamCreated', streamCreatedHandler);  
	
    
    session.connect(apiKey, token);
 
    var publisher;
    var subscribers = [];
    
    
 
    function sessionConnectedHandler(event) {
 

      // Subscribe to streams that were in the session when we connected
      subscribeToStreams(event.streams);
      		      
    }
    
    function join () {
    
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
     
     
    function unmute( stream )
    {
    	$('.nospeaker').show();
    	$('.speaker').hide();
    	$("#stream_"+stream).parent().find('.speaker').show();
    	$("#stream_"+stream).parent().find('.nospeaker').hide();
    
    	for (x in subscribers)
		{
			subscribers[x].subscribeToAudio( false ); 
		}
    
	
		if (stream in subscribers) {
		  //..
		  subscribers[ stream ].subscribeToAudio( true );
		}
		
    }
    
    function mute( stream )
    {
		$('.speaker').hide();
    	$('.nospeaker').show();
    
    	for (x in subscribers)
		{
			subscribers[x].subscribeToAudio( false ); 
		}
				
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
		var parentDiv = document.getElementById("stream_" + (i+participants));
		
		var stubDiv = document.createElement("div");
		stubDiv.id = "opentok_subscriber_" + streams[i].streamId;
		parentDiv.innerHTML = "";
		parentDiv.appendChild(stubDiv);
		
		
		var thumbDiv = document.createElement("div");
		thumbDiv.innerHTML = '<br><div class="clear"></div>'
			+'<img align="left" src="/karaoke/img/nospeaker.gif" width="25px" onclick="unmute('+(i+participants)+')" class="nospeaker" alt="NoSpeaker">'
			+'<img align="left" src="/karaoke/img/speaker.gif" width="25px" onclick="mute('+(i+participants)+')" class="speaker" alt="Speaker">'
			+'<div><img src="/karaoke/img/thumb_up.gif" class="thumb_up" token_id="'+streams[i].streamId+'" vote_choice="up" alt="Vote Up"></div>'
		parentDiv.appendChild(thumbDiv);
		
		

	
		subscribers[ (i+participants)] = session.subscribe(streams[i], stubDiv.id, {width: SUBSCRIBER_WIDTH, height: SUBSCRIBER_HEIGHT});
		
		subscribers[ (i+participants)].subscribeToAudio( false ); 
         	
         
      }
    }   
</script>

<script type="text/javascript">
function vote(token_id, vote_choice, div_element) {
	
	$.ajax({
		type: 'POST',
  	url: 'http://rnak.com/karaoke/karaoke_contest/add_vote/' 
  			+ token_id + "/" + vote_choice,
  	dataType: 'text',
  	success: function( new_count ){
  				
  				div_element.html('Rating: ' + new_count);
  			},
  	error: function(){ alert( "failure" ); }
	});
	
}

$(function(){
	
	$('.thumb_up').live("click", function(){
	var element = $(this);
	
	vote(element.attr('token_id'), element.attr('vote_choice'), element.parent());
	
	});
	
});                        


</script>

<div>

	<br>
		<div class="section">
		<span class="title"><?=$song['band']?> - <?=$song['name']?></span>
		</div><br>
		
		
		
		<? for( $i = 1 ; $i <= 4; $i++ ) { ?>
		
		<div class="stream_box">
		<div class="stream" id="stream_<?=$i?>">
			<?=$this->Html->image('profile-photo.jpg', array('alt' => 'CakePHP', 'class' => 'profile'))?> 
		</div>
		
		<br><div class="clear"></div>
		<!--
		<?= $this->Html->image('nospeaker.gif', array( "width" => "25px", 'onclick' => 'unmute('.$i.')', 'class' => 'nospeaker', "alt" => "Speaker")); ?>
		<?= $this->Html->image('speaker.gif', array( "width" => "25px", 'onclick' => 'mute('.$i.')', 'class' => 'speaker', "alt" => "Speaker")); ?>
		
		
		<span class='thumb_box' 'token_id' = '<?= $token ?>' >
			<?= $this->Html->image('thumb_up.gif',
					array('class' => 'thumb_up', 'token_id' => $token, 
							'vote_choice'=>'up', 'alt' => 'Vote Up')); ?>
		</span>
-->
		
		</div>
		
		<? } ?>

		

		<div class="clear"></div>
		
</div></div>
		
<div class="bottom_half">
				
	<br>	
	<div class="button" onclick="join();">Join Now!</div>
	<div class="music">
	
	<!--<embed src="<?=$html->webroot('mp3/'.$song['mp3']); ?>" width="300" height="30" AUTOSTART="false"  ></embed>-->
	</div>
	<center><iframe width="840" height="300" src="<?=$song['youtube']?>" frameborder="0" allowfullscreen></iframe></center>
	<br />
	<br />
	
</div>



	


