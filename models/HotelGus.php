<?php
	require_once 'models/Room.php';
	require_once 'Database.php';

	class HotelGus {
		private $rooms = array();

		public function __construct() {
			// Fill rooms array with data from database
			$db = Database::connect();
			$query = "SELECT * FROM rooms";
			
			foreach ($db->query($query) as $row) {
				$room = new Room($row['id'], $row['num_beds']);
				array_push($this->rooms, $room);
			}
		}
		

		// May add order by args
		public function getAvailableRooms($numBeds, $checkin, $checkout) {
			$availableRooms = array();

			foreach ($this->rooms as $room) {
				if ($room->getNumBeds() == $numBeds && $room->isAvailable($checkin, $checkout)) {
					array_push($availableRooms, $room);
				}
			}

			return $availableRooms;
		}

	}

?>