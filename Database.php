<?php
	
	// Handles database connection and disconnection
	// Uses PDO for database access
	class Database {
		private static $instance = NULL;

		private static $dbName = 'hotelgus_db';
		private static $dbHost = 'localhost';
		private static $dbUsername = 'root';
		private static $dbPassword = '';

		private function __construct() {}
		private function __clone() {}

		public static function connect() {
			if (self::$instance == NULL) {
				try {
					self::$instance = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUsername, self::$dbPassword);
				}
				catch(PDOException $e) {
					die($e->getMessage());
				}
			}

			return self::$instance;
		}

		public static function disconnect() {
			self::$instance = NULL;
		}
	}

?>