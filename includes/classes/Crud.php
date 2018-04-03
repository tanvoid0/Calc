<?php
include_once 'DbConfig.php';

class Crud extends DbConfig
{
	public function __construct()
	{
		parent::__construct();
	}

	public function show($table){
		$query = "SELECT * FROM ".$table;
		$result = $this->connection->query($query);
		if (!$result){
			return $result;
		}
		$rows = array();

		while ($row = $result->fetch_assoc()){
			$rows[] = $row;
		}
		return $rows;
	}

	public function insert($table, $into, $values){
		$query = "INSERT INTO ".$table." (".$into.") VALUES (".$values.")";
		$result = $this->connection->query($query);
		if(!$result){
			echo 'Error: Cannot Insert The data';
			return false;
		} else {
			return true;
		}
	}

	public function search($table, $column, $id){
		echo 'Working';
		$query = "SELECT * FROM ".$table." WHERE ".$column."=".$id;
		$result = $this->connection->query($query);

		if(!$result){
			echo 'Error: Cannot Search The data';
			return false;
		}
		$rows = array();
		while ($row = $result->fetch_assoc()){
			$rows[] = $row;
		}
        echo $rows;
		return $rows;

	}
	public function getData($query)
	{		
		$result = $this->connection->query($query);
		
		if ($result == false) {
			return false;
		} 
		
		$rows = array();
		
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		
		return $rows;
	}
		
	public function execute($query) 
	{
		$result = $this->connection->query($query);
		
		if ($result == false) {
			echo 'Error: cannot execute the command';
			return false;
		} else {
			return true;
		}		
	}
	
	public function delete($id, $table) 
	{ 
		$query = "DELETE FROM $table WHERE id = $id";
		
		$result = $this->connection->query($query);
	
		if ($result == false) {
			echo 'Error: cannot delete id ' . $id . ' from table ' . $table;
			return false;
		} else {
			return true;
		}
	}
	
	public function escape_string($value)
	{
		return $this->connection->real_escape_string($value);
	}
}
?>
