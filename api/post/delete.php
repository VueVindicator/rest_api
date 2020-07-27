<?php
//Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with');

include_once '../../config/database.php';
include_once '../../models/post.php';

//instantiate database and connect
$database = new database();
$db = $database->connect();

//instantiate blog post object
$post = new post($db);

//Get the raw posted data
$data = json_decode(file_get_contents("php://input"));

//set id to update
$post->id = $data->id;

//Delete Post
if($post->delete()){
	echo json_encode(
	   array('message' => 'Post Deleted')
	);
}else{
	echo json_encode(
	   array('message' => 'Post not Deleted')
	);
}
