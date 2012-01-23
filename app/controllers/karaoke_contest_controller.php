<?php

class KaraokeContestController extends AppController { 

	var $name = 'KaraokeContest';
	var $uses = array('Performance','Song');
	var $helpers = array('Html', 'Form', 'Javascript','Player');
			
	function index(){
	}
	
	function conference_sing($id=null){
	
		require_once 'SDK/API_Config.php';
		require_once 'SDK/OpenTokSDK.php';
		require_once 'SDK/SessionPropertyConstants.php';
	
		$apiObj = new OpenTokSDK(API_Config::API_KEY, API_Config::API_SECRET);
		
		if( isset( $id ) )
		{		
			$apiObj = new OpenTokSDK(API_Config::API_KEY, API_Config::API_SECRET);
					
			$song = $this->Song->find('first', array('conditions' => array('Song.id' => $id)));
			
			$this->set('song', $song['Song']);
			$this->set('token', $apiObj->generate_token($song['Song']['session']));
		
		}
		else
		{
			var_dump( $_POST);
			$song['Song']['youtube'] = $this->data['youtube'];
			$this->set('song', $song['Song']['youtube']);
		}
	}

	function add_vote($token_id, $vote_choice) {
		
		$this->autoRender = false;

		$vote_added = ($vote_choice == 'up') ? 1 : -1;

		$performance = $this->Performance->find('first', array('conditions' => array('Performance.token_id' => $token_id)));
		
		// Add new performance
		if ( empty($performance) ) {
			
			$this->Performance->id = null;
			$this->Performance->save(array(
								'token_id' => $token_id,
								'name' => 'unknown',
								'song' => 'unknown',
								'vote_count' => $vote_added
			));
			echo $vote_added;
		}
		// Add update performance
		else {
			$vote_count = ($performance['Performance']['vote_count']);
			
			$this->Performance->id = $performance['Performance']['id'];							
			$this->Performance->save(array(
								'vote_count' => $vote_count + $vote_added
			));
			
			echo ($vote_count + $vote_added);
			
		}
	}
	
	function test(){
		
	}
}