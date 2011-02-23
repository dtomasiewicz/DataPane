<?php
	namespace DataPane\Driver\PDO;
	use \PDO,
	    \DataPane\Platform,
	    \DataPane\Query;
	
	class Connection implements \DataPane\Connection {
		private $__pdo;
		
		public function __construct($config) {
			$this->__pdo = new PDO($config['dsn'], $config['user'], $config['password']);
			$this->__pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		
		public function prepare($sql, $driver_options = array()) {
			if($sql instanceof Query) {
				$sql = $this->getSQL($sql);
			}
			
			return new Statement($this->__pdo->prepare($sql, $driver_options));
		}
		
		public function lastInsertID() {
			return $this->__pdo->lastInsertId();
		}
		
		public function getSQL(Query $query) {
			switch($driver = $this->__pdo->getAttribute(PDO::ATTR_DRIVER_NAME)) {
				case 'mysql':
					return Platform\MySQL::parseQuery($query);
				default:
					throw new InvalidDriverException($driver);
			}
		}
	}