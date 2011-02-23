<?php
	namespace DataPane;
	
	interface Connection {
		public function lastInsertId();
		public function prepare($sql);
	}