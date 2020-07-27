<?php 
class category{
	//handle connection
	public $conn;
	public $table = 'categories'; 

	//post properties
	public $id;
	public $name;

	public function __construct($db){
		$this->conn = $db;
	}

	public function read_cat(){
		//create query
		$query = 'SELECT
		    id,
		    name,
		    created_at
		  FROM ' . $this->table . '
		    ORDER BY
		       created_at DESC';

		//prepare statements
		$stmt = $this->conn->prepare($query);

		//execute query
		$stmt->execute();

		//return result
		return $stmt;
	}
}