<?php
	require_once 'Color.class.php';

	class Vertex {
		private $_x;
		private $_y;
		private $_z;
		private $_w = 1.0;
		private $_c;
		static $verbose = false;

		public function __construct(array $xyzwc) {
			if (isset($xyzwc['w'])) {
				$this->_w = $xyzwc['w'];
			}
			if (isset($xyzwc['color'])) {
				$this->_c = $xyzwc['color'];
			} else {
				$this->_c = new Color( array(
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

		public function __set($attr, $value) {
			$this->$attr = $value;
		}

		public function __get($attr) {
			return ($this->$attr);
		}

		public function __destruct() {
			if (self::$verbose) {
				printf($this . " destructed\n");
			}
		}

		public function __tostring() {
			if (self::$verbose) {
				return ($ret =
				sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, $this->_c )",
				$this->_x, $this->_y, $this->_z, $this->_w) );
			} else {
				return ($ret =
				sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )",
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
	}
?>
