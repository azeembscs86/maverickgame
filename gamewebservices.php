<?php
include("dbconnection.php");
if(isset($_GET['game_id'])) {
		
	//$format = strtolower($_GET['format']) == 'json' ? 'json' : 'xml'; //xml is the default
	$game_id = $_GET['game_id']; //no default	
      
	/* grab the posts from the db */
	$game_query="select game_id,game_name,game_image,game_background_image,game_description,isActive,createdAt, updatedAt, isFeatured, game_seo, meta_tag_keywords, meta_tag_description,game_top_header FROM silverhat_games where game_id=$game_id";
	$game_result = mysql_query($game_query) or die(mysql_error());
	/* create one master array of the records */
	$game_posts = array();
	if(mysql_num_rows($game_result)) {
		while($game_post = mysql_fetch_assoc($game_result)) {
			$game_posts[] = array('game_post'=>$game_post);
		}
	}
        header('Content-type: application/json');
        echo json_encode($game_posts);
		
}
?>