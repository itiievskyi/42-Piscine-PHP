<?php
	require_once 'Color.class.php';
	require_once 'Vertex.class.php';
	require_once 'Vector.class.php';

	class Matrix {
		private $_preset;
		private $_scale;
		private $_angle;
		private $_vtc;
		private $_fov;
		private $_ratio;
		private $_near;
		private $_far;
		private $_matrix = array();
		static $verbose = false;

		const IDENTITY = "IDENTITY";
		const SCALE = "SCALE";
		const RX = "Ox ROTATION";
		const RY = "Oy ROTATION";
		const RZ = "Oz ROTATION";
		const TRANSLATION = "TRANSLATION";
		const PROJECTION = "PROJECTION";

		public function __construct(array $mtrx) {
			if (in_array($mtrx['preset'], array(
				'IDENTITY', 'SCALE', 'Ox ROTATION', 'Oy ROTATION',
				'Oz ROTATION', 'TRANSLATION', 'PROJECTION'))) {
					$this->_preset = $mtrx['preset'];
			} else {
				echo "Error: bad preset name\n";
				return ;
			}
			$this->parse($mtrx);
			if ($this->check() == false) {
				echo "Error: some arguments are missed\n";
				return ;
			}
			$this->init_Matrix();
			if (self::$verbose) {
				if ($this->_preset == self::IDENTITY) {
					echo "Matrix " . $this->_preset . " instance constructed\n";
				} else {
					echo "Matrix " . $this->_preset .
						 " preset instance constructed\n";
				}
			}
			$this->start();
		}

		private function parse($mtrx) {
			if (isset($mtrx['scale'])) {
				$this->_scale = $mtrx['scale'];
			}
			if (isset($mtrx['angle'])) {
				$this->_angle = $mtrx['angle'];
			}
			if (isset($mtrx['vtc'])) {
				$this->_vtc = $mtrx['vtc'];
			}
			if (isset($mtrx['fov'])) {
				$this->_fov = $mtrx['fov'];
			}
			if (isset($mtrx['ratio'])) {
				$this->_ratio = $mtrx['ratio'];
			}
			if (isset($mtrx['near'])) {
				$this->_near = $mtrx['near'];
			}
			if (isset($mtrx['far'])) {
				$this->_far = $mtrx['far'];
			}
		}

		private function check() {
			if (empty($this->_preset)) {
				return false;
			}
			if ($this->_preset == self::SCALE && empty($this->_scale)) {
				return false;
			}
			if (($this->_preset == self::RX || $this->_preset == self::RY ||
				$this->_preset == self::RZ) && empty($this->_angle)) {
				return false;
			}
			if ($this->_preset == self::TRANSLATION && empty($this->_vtc)) {
				return false;
			}
			if ($this->_preset == self::PROJECTION && (empty($this->_fov) ||
				empty($this->_radio) || empty($this->_near) ||
				empty($this->_far))) {
				return false;
			}
			return true;
		}

		private function init_Matrix()
		{
			for ($i = 0; $i < 16; $i++) {
				$this->$_matrix[$i] = 0;
			}
			$this->$_matrix[15] = 1;
		}

		private function start() {
			if ($this->_preset == self::IDENTITY) {
				$this->identity();
			}
		}

		private function identity() {
	//		$this->$_matrix[0][0] = 1;
	//		$_matrix[1][1] = 1;
	//		$_matrix[2][2] = 1;
		}

		public function __destruct() {
			if (self::$verbose) {
				print("Matrix instance destructed\n");
			}
		}

		public function __tostring() {
			echo "$_matrix[15]";
			$str = sprintf("M | vtcX | vtcY | vtcZ | vtxO\n");
			$str .= sprintf("-----------------------------\n");
			$str .= sprintf("x | %0.2f | %0.2f | %0.2f | %0.2f\n",
				$this->$_matrix[0], $_matrix[0][1], $_matrix[0][2], $_matrix[0][3]);
			$str .= sprintf("y | %0.2f | %0.2f | %0.2f | %0.2f\n",
				$_matrix[1][0], $_matrix[1][1], $_matrix[1][2], $_matrix[1][3]);
			$str .= sprintf("z | %0.2f | %0.2f | %0.2f | %0.2f\n",
				$_matrix[2][0], $_matrix[2][1], $_matrix[2][2], $_matrix[2][3]);
			$str .= sprintf("w | %0.2f | %0.2f | %0.2f | %0.2f",
				$_matrix[3][0], $_matrix[3][1], $_matrix[3][2], $_matrix[15]);
			return ($str);
		}

		public function doc() {
			if ($str = file_get_contents('Matrix.doc.txt')) {
				echo "$str";
			}
			else {
				echo "Error: .doc file doesn't exist.\n";
			}
		}

		public function __get($attr) {

		}
	}
?>
