<?php
	namespace DataPane\Driver\PDO;
	use \PDOStatement,
	    \PDO;
	
	class Statement implements \DataPane\Statement {
		private $__pdoStmt;
		
		public function __construct(PDOStatement $stmt) {
			$this->__pdoStmt = $stmt;
		}
		
		public function execute($params = array()) {
			return $this->__pdoStmt->execute((array)$params);
		}
		
		public function fetch($fetchStyle = PDO::FETCH_ASSOC, $cursorOrientation = PDO::FETCH_ORI_NEXT, $cursorOffset = 0) {
			return $this->__pdoStmt->fetch($fetchStyle, $cursorOrientation, $cursorOffset);
		}
		
		public function fetchAll($fetchStyle = PDO::FETCH_ASSOC) {
			return $this->__pdoStmt->fetchAll($fetchStyle);
		}
	}