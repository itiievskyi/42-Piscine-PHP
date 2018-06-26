<?php
	class Color {
		public $red;
		public $green;
		public $blue;
		static $verbose = false;

		public function __construct($arr) {
			if (isset($arr['rgb'])) {
				$color = intval($arr['rgb'], 10);
				$this->red = $color / 65536;
				$this->green = $color % 65536 / 256;
				$this->blue = $color % 65536 % 256;
			} else if (
				isset($arr['red']) && isset($arr['green']) && isset($arr['blue'])) {
				$this->red = intval($arr['red'], 10);
				$this->green = intval($arr['green'], 10);
				$this->blue = intval($arr['blue'], 10);
			}
			if (self::$verbose) {
				printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n", $this->red, $this->green, $this->blue);
			}
		}

		public function __destruct() {
			if (self::$verbose) {
				printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n", $this->red, $this->green, $this->blue);
			}
		}

		public function __tostring() {
			$ret = sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->blue);
			return $ret;
		}

		public function doc() {
			if ($str = file_get_contents('Color.doc.txt')) {
				echo "$str";
			}
			else {
				echo "Error: .doc file doesn't exist.\n";
			}
		}

		public function add($col) {
			$new = new Color( array(
				'red' => $this->red + $col->red,
				'green' => $this->green + $col->green,
				'blue' => $this->blue + $col->blue,
			) );
			return $new;
		}

		public function sub($col) {
			$new = new Color( array(
				'red' => $this->red - $col->red,
				'green' => $this->green - $col->green,
				'blue' => $this->blue - $col->blue,
			) );
			return $new;
		}

		public function mult($col) {
			if ($col->red && $col->green && $col->blue) {
				$new = new Color( array(
					'red' => $this->red * $col->red,
					'green' => $this->green * $col->green,
					'blue' => $this->blue * $col->blue,
				) );
			} else if (is_numeric($col)) {
				$new = new Color( array(
					'red' => $this->red * $col,
					'green' => $this->green * $col,
					'blue' => $this->blue * $col
				) );
			}
			return $new;
		}
	}
?>
