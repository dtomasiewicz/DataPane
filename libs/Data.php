<?php
	namespace DataPane;
	
	abstract class Data {
		protected static $_connections;
		protected static $_config;
		
		public static function init($config) {
			self::$_connections = array();
			self::$_config = $config + array(
				'connections' => array()
			);
		}
		
		public static function connection($name = null) {
			if($name === null) {
				$name = 'default';
			}
			
			if (!isset(self::$_connections[$name])) {
				if (isset(self::$_config['connections'][$name])) {
					$config = self::$_config['connections'][$name];
					$class = '\\DataPane\\Driver\\'.$config['driver'].'\\Connection';
					unset($config['driver']);
					self::$_connections[$name] = new $class($config);
				} else {
					//@todo exception
					exit('Invalid connection: '.$name);
				}
			}
			
			return self::$_connections[$name];
		}
	}