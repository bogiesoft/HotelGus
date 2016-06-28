<?php
	require_once 'Database.php';

	class Room {
		private $id;
		private $numBeds;

		public function __construct($id, $beds) {
			$this->id = $id;
			$this->numBeds = $beds;
		}


		public function getNumBeds() {
			return $this->numBeds;
		}

		public function getID() {
			return $this->id;
		}
		

		// Takes in date range, checks if room occupied during those dates
		public function isAvailable($checkin, $checkout) {
			// Convert to DateTime objects to be compared
			$usrCheckIn = new DateTime($checkin);
			$usrCheckOut = new DateTime($checkout);

			$dateRanges = $this->getOccupiedDates();

			foreach ($dateRanges as $dateRange) {
				$roomCheckIn = new DateTime($dateRange['roomCheckIn']);
				$roomCheckOut = new DateTime($dateRange['roomCheckOut']);

				// Check for date ranges overlap. Includes overlapping edge dates.
				if ($usrCheckIn <= $roomCheckOut && $usrCheckOut >= $roomCheckIn) {
					return false;
				}
			}

			return true;
		}


		// Returns array of assoc. arrays of date ranges this room is occupied
		private function getOccupiedDates() {
			$dateRanges = [];

			$db = Database::connect();
			$query = "SELECT * FROM occupied_dates WHERE room='$this->id'";

			foreach ($db->query($query) as $row) {
				$dateRange = ["roomCheckIn" => $row['checkin'],
							"roomCheckOut" => $row['checkout']];

				array_push($dateRanges, $dateRange);
			}

			return $dateRanges;
		}


		// Creates reservation for this room
		public static function book($id, $checkin, $checkout, $lastname) {
			// Convert dates to Y-m-d format before inserting to database
			$checkin = new DateTime($checkin);
			$ymdCheckIn = $checkin->format('Y-m-d');
			$checkout = new DateTime($checkout);
			$ymdCheckOut = $checkout->format('Y-m-d');

			$db = Database::connect();
			$query = "INSERT INTO occupied_dates VALUES (null, '$id', '$ymdCheckIn', '$ymdCheckOut', '$lastname')";
			$db->exec($query);
		}


		// Returns price per night
		public function getPrice() {
			switch ($this->numBeds) {
				case 1:
					return 100;
				case 2:
					return 150;
				case 3:
					return 200;
				default:
					throw new UnexpectedValueException();
			}
		}


		// Returns total price
		public static function calculateTotal($price, $checkin, $checkout) {
			$checkin = new DateTime($checkin);
			$checkout = new DateTime($checkout);

			$interval = $checkin->diff($checkout);
			$totalCost = $interval->days * $price;

			return $totalCost;
		}

	}

?>