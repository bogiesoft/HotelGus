<?php

	class SearchView {
		private $model;

		public function __construct($model) {
			$this->model = $model;
		}

		public function output() {			
			require_once 'views/SearchView.html';
		}
	}

?>