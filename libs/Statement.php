<?php
	namespace DataPane;
	
	interface Statement {
		public function execute($params = array());
		public function fetch();
		public function fetchAll();
	}