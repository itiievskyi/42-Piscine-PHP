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
		protected $_matrix;
		static $verbose = false;

		const IDENTITY = "IDENTITY";
		const SCALE = "SCALE";
		const RX = "Ox ROTATION";
		const RY = "Oy ROTATION";
		const RZ = "Oz ROTATION";
		const TRANSLATION = "TRANSLATION";
		const PROJECTION = "PROJECTION";

		public function __construct($mtrx = null) {
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
			$this->dispatcher();
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

		private function dispatcher() {
			switch ($this->_preset) {
				case (self::IDENTITY) :
					$this->identity(1);
					break;
				case (self::TRANSLATION) :
					$this->translation();
					break;
				case (self::SCALE) :
					$this->identity($this->_scale);
					break;
				case (self::RX) :
					$this->rotation_x();
					break;
				case (self::RY) :
					$this->rotation_y();
					break;
				case (self::RZ) :
					$this->rotation_z();
					break;
				case (self::PROJECTION) :
					$this->projection();
					break;
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
				$this->_matrix[$i] = 0;
			}
		}

		public function mult(Matrix $rhs) {
			$tmp = array();
			for ($i = 0; $i < 16; $i += 4) {
				for ($j = 0; $j < 4; $j++) {
					$tmp[$i + $j] = 0;
					$tmp[$i + $j] += $this->matrix[$i + 0] * $rhs->matrix[$j + 0];
					$tmp[$i + $j] += $this->matrix[$i + 1] * $rhs->matrix[$j + 4];
					$tmp[$i + $j] += $this->matrix[$i + 2] * $rhs->matrix[$j + 8];
					$tmp[$i + $j] += $this->matrix[$i + 3] * $rhs->matrix[$j + 12];
				}
			}
			$matrice = new Matrix();
			$matrice->matrix = $tmp;
			return $matrice;
		}

		private function translation()
		{
			$this->identity(1);
			$this->_matrix[3] = $this->_vtc->getX();
			$this->_matrix[7] = $this->_vtc->y;
			$this->_matrix[11] = $this->_vtc->z;
		}

		private function identity($scale)
		{
			$this->_matrix[0] = $scale;
			$this->_matrix[5] = $scale;
			$this->_matrix[10] = $scale;
			$this->_matrix[15] = 1;
		}
		public function __destruct() {
			if (self::$verbose) {
				print("Matrix instance destructed\n");
			}
		}

		function __toString()
		{
			$tmp = "M | vtcX | vtcY | vtcZ | vtxO\n";
			$tmp .= "-----------------------------\n";
			$tmp .= "x | %0.2f | %0.2f | %0.2f | %0.2f\n";
			$tmp .= "y | %0.2f | %0.2f | %0.2f | %0.2f\n";
			$tmp .= "z | %0.2f | %0.2f | %0.2f | %0.2f\n";
			$tmp .= "w | %0.2f | %0.2f | %0.2f | %0.2f";
			return (vsprintf($tmp, array(
				$this->_matrix[0], $this->_matrix[1], $this->_matrix[2], $this->_matrix[3],
				$this->_matrix[4], $this->_matrix[5], $this->_matrix[6], $this->_matrix[7],
				$this->_matrix[8], $this->_matrix[9], $this->_matrix[10], $this->_matrix[11],
				$this->_matrix[12], $this->_matrix[13], $this->_matrix[14], $this->_matrix[15])));
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
