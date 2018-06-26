<?php
	class Color {
		public $red;
		public $green;
		public $blue;
		static $verbose = false;

		function __construct($arr) {
			if (isset($arr['rgb'])) {
				$color = intval($arr['rgb'], 10);
				$this->red = $color / 256 / 256;
				$this->green = $color / 256;
				$this->blue = $color % 256;
			} else if (isset($arr['red']) && isset($arr['green']) && isset($arr['blue'])) {
				$this->red = intval($arr['red'], 10);
				$this->green = intval($arr['green'], 10);
				$this->blue = intval($arr['blue'], 10);
			}
			if (self::$verbose) {
				printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n", $this->red, $this->green, $this->blue);
			}
		}

		public function doc() {
			if ($str = file_get_contents('Color.doc.txt')) {
				echo "$str";
			}
			else {
				echo "Error: .doc file doesn't exist.\n";
			}
		}
	}
?>
