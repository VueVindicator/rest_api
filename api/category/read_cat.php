<?php
//Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../models/category.php';

$database = new database();
$db = $database->connect();

$category = new category($db);

//query the data
$result = $category->read_cat();

//count rows
$num_rows = $result->rowCount();

if($num_rows > 0){

	//post array
	$post_array = array();
	$post_array['data'] = array();

	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		extract($row);

		//post data
		$post_data = array(
			"id" => $id,
			"name" => $name
		);
		array_push($post_array['data'], $post_data);
	}
	echo json_encode($post_array);
}else{
	echo json_encode(
		array("message" => "Category not added")
	);
}

