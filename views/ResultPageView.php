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
			if (!empty($availableRooms)) {
				foreach ($availableRooms as $room) {
					$roomID = $room->getID();
					$price = $room->getPrice();

					require 'views/RoomView.html';
				}
			}
			else {
				echo "No available ".$numBeds." bed rooms between ".$checkin." and ".$checkout.".";
			}

			echo "<p><form action='?route=search' method='post'>
	    			<input type='submit' value='Home'> </form>
				</p>";
		}

	}

?>