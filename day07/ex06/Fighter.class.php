<?php
	class Fighter {
		private $name;

		public function __construct($str) {
			if ($str) {
				$this->$name = $str;
			} else {
				$this->$name = NULL;
			}
		}
		public function __tostring() {
			if ($this->$name) {
				return($this->$name);
			}
		}
	}
?>
