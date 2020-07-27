<?php
//Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

//Create Post
if($post->create()){
	echo json_encode(
	   array('message' => 'Post Created')
	);
}else{
	echo json_encode(
	   array('message' => 'Post not Created')
	);
}
