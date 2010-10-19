<?php
	namespace DataPane\Driver\PDO;
	use \PDO;
	
	class Connection extends PDO implements \DataPane\Connection {
		public function __construct($config) {
			parent::__construct($config['dsn'], $config['user'], $config['password']);
			$this->setAttribute(PDO::ATTR_STATEMENT_CLASS, array('DataPane\\Driver\\PDO\\Statement', array()));
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		
		public function prepare($sql, $driver_options = array()) {
			if($sql instanceof \DataPane\Query) {
				switch($this->getAttribute(PDO::ATTR_DRIVER_NAME)) {
					case 'mysql':
						$sql = call_user_func(array('DataPane\\Platform\\MySQL', 'parseQuery'), $sql);
						break;
					default:
						//@todo exception
						exit('Invalid PDO driver.');
				}
			}
			
			return parent::prepare($sql, $driver_options);
		}
	}