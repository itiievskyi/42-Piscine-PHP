<?php
	require_once 'Color.class.php';

	class Vertex {
		private $_x;
		private $_y;
		private $_z;
		private $_w = 1.0;
		private $_color;
		static $verbose = false;

		public function __construct(array $xyzwc) {
			if (isset($xyzwc['w'])) {
				$this->_w = $xyzwc['w'];
			}
			if (isset($xyzwc['color'])) {
				$this->_color = $xyzwc['color'];
			} else {
				$this->_color = new Color( array(
					'red' => 255,
					'green' => 255,
					'blue' => 255
				) );
			}
			if (
				isset($xyzwc['x']) &&
				isset($xyzwc['y']) &&
				isset($xyzwc['z'])) {
					$this->_x = $xyzwc['x'];
					$this->_y = $xyzwc['y'];
					$this->_z = $xyzwc['z'];
			}
			if (self::$verbose) {
				printf($this . " constructed\n");
			}
		}

		public function __destruct() {
			if (self::$verbose) {
				printf($this . " destructed\n");
			}
		}

		public function __tostring() {
			if (self::$verbose) {
				return ($ret = sprintf(
					"Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, $this->_color )",
					$this->_x, $this->_y, $this->_z, $this->_w) );
			} else {
				return ($ret = sprintf(
					"Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )",
					$this->_x, $this->_y, $this->_z, $this->_w) );
			}
		}

		public function doc() {
			if ($str = file_get_contents('Vertex.doc.txt')) {
				echo "$str";
			}
			else {
				echo "Error: .doc file doesn't exist.\n";
			}
		}

		public function __get($attr) {
			if ($attr == '_x') {
				return ($this->getX());
			} else if ($attr == '_y') {
				return ($this->getY());
			} else if ($attr == '_z') {
				return ($this->getZ());
			} else if ($attr == '_w') {
				return ($this->getW());
			} else if ($attr == '_color') {
				return ($this->getColor());
			}
		}

		public function __set($attr, $value) {
			if ($attr == '_x') {
				$this->setX($value);
			} else if ($attr == '_y') {
				$this->setY($value);
			} else if ($attr == '_z') {
				$this->setZ($value);
			} else if ($attr == '_w') {
				$this->setW($value);
			} else if ($attr == '_color') {
				$this->setColor($value);
			}
		}

		private function getX() {
			return $this->_x;
		}

		private function getY() {
			return $this->_y;
		}

		private function getZ() {
			return $this->_z;
		}

		private function getW() {
			return $this->_w;
		}

		private function getColor() {
			return $this->_color;
		}

		private function setX($x) {
			$this->_x = $x;
		}

		private function setY($y) {
			$this->_y = $y;
		}

		private function setZ($z) {
			$this->_z = $z;
		}

		private function setW($w) {
			$this->_w = $w;
		}

		private function setColor($color) {
			$this->_color = $color;
		}
	}
?>
