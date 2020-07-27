<?php
//Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../models/post.php';

//instantiate database and connect
$database = new database();
$db = $database->connect();

//instantiate blog post object
$post = new post($db);

//Blog post query
$result = $post->read();

//Get row count
$num = $result->rowCount();

//check if theres any post
if($num > 0){
	//post array
	$posts_arr = array();
	$posts_arr['data'] = array();

	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		extract($row);

		$post_item = array(
			'id' => $id,
			'title' => $title,
			'body' => html_entity_decode($body),
			'author' => $author,
			'category_id' => $category_id,
			'category_name' => $category_name
		);

		//Push to data
		array_push($posts_arr['data'], $post_item);
	}
	//Turn to JSON 
	echo json_encode($posts_arr);
}else{
	echo json_encode(
		array('message' => 'No categories found')
	);
}
?>