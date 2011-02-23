<?php
	namespace DataPane;
	
	class Query {
		const SELECT = 'SELECT';
		const INSERT = 'INSERT';
		const UPDATE = 'UPDATE';
		const DELETE = 'DELETE';
		
		public $type;
		public $fields = null;
		public $from = null;
		public $tables = null;
		public $into = null;
		public $table = null;
		public $where = array();
		public $order = null;
		public $limit = null;
		public $offset = null;
		public $having = array();
		public $group = null;
		public $set = null;
		public $values = null;
		
		public function __construct($type) {
			$this->type = $type;
		}
		
		public function fields($fields) {
			$this->fields = $fields;
			return $this;
		}
		
		public function from($from) {
			$this->from = $from;
			return $this;
		}
		
		public function table($table) {
			$this->table = $table;
			return $this;
		}
		
		public function into($table) {
			$this->table = $table;
			return $this;
		}
		
		public function where($conditions) {
			$this->where[] = (array) $conditions;
			return $this;
		}
		
		public function orderBy($order) {
			$this->order = $order;
			return $this;
		}
		
		public function limit($limit, $offset = null) {
			$this->limit = $limit;
			if($offset != null) {
				$this->offset = $offset;
			}
			return $this;
		}
		
		public function offset($offset) {
			$this->offset = $offset;
			return $this;
		}
		
		public function having($conditions) {
			$this->having[] = (array) $conditions;
			return $this;
		}
		
		public function groupBy($group) {
			$this->group = $group;
			return $this;
		}
		
		public function set($set) {
			$this->set = $set;
			return $this;
		}
		
		public function values($values) {
			$this->values = $values;
		}
		
		public function getSQL($connection = null) {
			return Data::connection($connection)->getSQL($this);
		}
		
		public function prepare($driver_options = array(), $connection = null) {
			return Data::connection($connection)->prepare($this, $driver_options);
		}
		
		public function execute($params = array(), $connection = null, $driverOptions = array()) {
			return $this->prepare($driverOptions, $connection)->execute($params);
		}
		
		public function fetch($params = array(), $connection = null, $driverOptions = array()) {
			$stmt = $this->prepare($driverOptions, $connection);
			$stmt->execute($params);
			return $stmt->fetch();
		}
		
		public function fetchAll($params = array(), $connection = null, $driverOptions = array()) {
			$stmt = $this->prepare($driverOptions, $connection);
			$stmt->execute($params);
			return $stmt->fetchAll();
		}
	}