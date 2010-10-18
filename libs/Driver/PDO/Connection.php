<?php
	namespace DataPane\Driver\PDO;
	use \PDO;
	
	class Connection extends PDO implements \DataPane\Connection {
		public function __construct($config) {
			parent::__construct($config['dsn'], $config['user'], $config['password']);
			$this->setAttribute(PDO::ATTR_STATEMENT_CLASS, array('DataPane\\Driver\\PDO\\Statement', array()));
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	}