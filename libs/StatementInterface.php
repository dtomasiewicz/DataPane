<?php
	namespace DataPane;
	
	interface StatementInterface {
		public function execute($params = array());
		public function fetch();
		public function fetchAll();
	}