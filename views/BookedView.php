<?php

	class BookedView {
		private $model;

		public function __construct($model) {
			$this->model = $model;
		}

		// Displays booked room info
		public function output() {
			$checkin = $_POST['checkin'];
			$checkout = $_POST['checkout'];

			$totalPrice = Room::calculateTotal($_POST['price'], $checkin, $checkout);

			$lastname = $_SESSION['lastname'];

			require 'views/BookedView.html';
		}
	}

?>