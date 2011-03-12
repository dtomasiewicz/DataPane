<?php
	namespace DataPane\Driver\PDO;
	use \PDOStatement,
	    \PDO;
	
	class Statement implements \DataPane\StatementInterface {
		private $pdoStmt;
		
		public function __construct(PDOStatement $stmt) {
			$this->pdoStmt = $stmt;
		}
		
		public function execute($params = array()) {
			return $this->pdoStmt->execute((array)$params);
		}
		
		public function fetch($fetchStyle = PDO::FETCH_ASSOC, $cursorOrientation = PDO::FETCH_ORI_NEXT, $cursorOffset = 0) {
			return $this->pdoStmt->fetch($fetchStyle, $cursorOrientation, $cursorOffset);
		}
		
		public function fetchAll($fetchStyle = PDO::FETCH_ASSOC) {
			return $this->pdoStmt->fetchAll($fetchStyle);
		}
	}