<?php
	require_once 'models/Room.php';

	class BookedViewController {
		private $model;

		public function __construct($model) {
			$this->model = $model;
		}

		// Reserves a room
		public function book() {
			session_start();
			Room::book($_POST['roomID'], $_POST['checkin'], $_POST['checkout'], $_SESSION['lastname']);
		}
	}

?>