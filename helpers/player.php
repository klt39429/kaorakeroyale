<?php


class PlayerHelper extends AppHelper {
	
	var $helpers = array('Html');
	
    function getPlayer($id) {

		$message = "<span id=$id>";
		
		$message .= "<span class='stream' id='stream_$id'>";
		$message .= $this->Html->image('profile-photo.jpg');
		$message .= "</span><br />";

		$message .= "<span class='thumb_up' user_id=$id vote_choice='up'>";
		$message .= $this->Html->image('thumb_up.gif');
		$message .= "</span>";

		$message .= "<span class='thumb_up' user_id=$id vote_choice='down'>";
		$message .= $this->Html->image('thumb_down.gif');
		$message .= "</span>";

		$message .= "</span>";

		return $message;        
    }
}

?>
