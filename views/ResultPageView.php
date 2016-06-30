<?php

	class ResultPageView {
		private $model;

		public function __construct($model) {
			$this->model = $model;
		}

		// Display list of room views
		public function output() {
			session_start();
			$_SESSION['lastname'] = $_POST['lastname'];

			$checkin = $_POST['checkin'];
			$checkout = $_POST['checkout'];
			$numBeds = $_POST['numBeds'];

			$availableRooms = $this->model->getAvailableRooms($numBeds, $checkin, $checkout);
			
			require_once 'views/ResultPageView.html';
		}

	}

?>