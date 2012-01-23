<?php

class KaraokeContestController extends AppController { 

	var $name = 'KaraokeContest';
	var $uses = array('Performance','Song');
	var $helpers = array('Html', 'Form', 'Javascript','Player');
			
	function index(){
	}
	
	function conference_sing($id){
		$song = $this->Song->find('first', array('conditions' => array('Song.id' => $id)));
		$this->set('song', $song['Song']);
	}

	function add_vote($id, $vote_choice) {
		
		$this->autoRender = false;
						
		$vote_added = ($vote_choice == 'up') ? 1 : -1;

		$performance = $this->Performance->find('first', array('conditions' => array('Performance.id' => $id)));
		$vote_count = ($performance['Performance']['vote_count']);
		
			
		$this->Performance->save(array(
							'id' => $id,
							'vote_count' => $vote_count + $vote_added
		));
		
		return $vote_count + $vote_added;
	}
	
	function test(){
		
	}
}