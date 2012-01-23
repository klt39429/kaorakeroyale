<style> body{background: black; } #content{background: black; text-align:center;} a {
text-decoration: none;
}</style>
<br><br><br>
<div class='main_img'>
<?php echo $this->Html->image("final-bee.jpg", array(
	"height" => "200",
	"style" => "margin:10px;",
    "alt" => "Brownies",
    'url' => array('controller' => 'karaoke_contest', 'action' => 'conference_sing', 5)
	
)); 
?>
<?php echo $this->Html->image("final-coolio.jpg", array(
	"height" => "200",
	"style" => "margin:10px;",
    "alt" => "Brownies",
    'url' => array('controller' => 'karaoke_contest', 'action' => 'conference_sing', 3),
	'class' => 'main_img'
)); 
?>
<?php echo $this->Html->image("final-garth.jpg", array(
	"height" => "200",
	"style" => "margin:10px;",
    "alt" => "Brownies",
    'url' => array('controller' => 'karaoke_contest', 'action' => 'conference_sing', 4),
	'class' => 'main_img'
)); 
?>
<?php echo $this->Html->image("final-journey.jpg", array(
	"height" => "200",
	"style" => "margin:10px;",
    "alt" => "Brownies",
    'url' => array('controller' => 'karaoke_contest', 'action' => 'conference_sing', 1),
	'class' => 'main_img'
)); 
?>
<?php echo $this->Html->image("final-madonna.jpg", array(
	"height" => "200",
	"style" => "margin:10px;",
    "alt" => "Brownies",
    'url' => array('controller' => 'karaoke_contest', 'action' => 'conference_sing', 2),
	'class' => 'main_img'
)); 
?>
<br><br><br><br>
<?php echo $this->Form->create('KaraokeContest', array('controller' => 'karaoke_contest', 'action' => 'conference_sing'));?>

<?php

echo $this->Form->input('youtube', array('style'=>"width:400px;font-size:0.65em;", 'value'=>"http://www.youtube.com/embed/n0TzY6DLxvU"));

?>

<?php echo $this->Form->end(__('Submit', true)); ?>

</form>

</div>