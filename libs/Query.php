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
		public $where = array();
		public $order = null;
		public $limit = null;
		public $offset = null;
		public $having = array();
		public $group = null;
		
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
		
		public function where() {
			$this->where = func_get_args();
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
		
		public function having() {
			$this->having = func_get_args();
			return $this;
		}
		
		public function groupBy($group) {
			$this->group = $group;
			return $this;
		}
		
		public function connection($connection = null) {
			$this->connection = $connection;
			return $this;
		}
		
		public function prepare($connection = null) {
			return Data::connection($connection)->prepare($this);
		}
		
		public function exec($params = null, $connection = null) {
			return Data::connection($connection)->execute($this);
		}
	}