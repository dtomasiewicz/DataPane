<?php
	namespace DataPane;
	
	interface ConnectionInterface {
		public function lastInsertId();
		public function prepare($sql);
	}