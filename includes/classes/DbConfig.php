<?php
class DbConfig
{
	private $_host = 'localhost';
	private $_username = 'root';
	private $_password = '';
	private $_database = 'calc';

	// 000webhost.com
	// private $_username = 'id3403048_root';
	// private $_password = 'Junayed123'
	// private $_database = 'id3403048_blog';

	// http://tanveer6334.5gbfree.com:2082/
	// private $_username = 'tanveer6_login';
	// private $_password = 'Junayed123';
	// private $_database = 'tanveer6_blog';


	protected $connection;

	public function __construct()
	{
		if (!isset($this->connection)) {

			$this->connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

			if (!$this->connection) {
				echo 'Cannot connect to database server';
				exit;
			}
		}

		return $this->connection;
	}
}
?>
