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
			if (isset($mtrx)) {
				$this->parse($mtrx);
				$this->check();
				$this->init_Matrix();
				if (self::$verbose) {
					if ($this->_preset == self::IDENTITY) {
						echo "Matrix " . $this->_preset . " instance constructed\n";
					} else {
						echo "Matrix " . $this->_preset .
							 " preset instance constructed\n";
					}
				}
				$this->choose_func();
			}
		}

		private function parse($mtrx) {
			if (isset($mtrx['preset'])) {
				$this->_preset = $mtrx['preset'];
			}
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

		private function choose_func() {
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
				return "error";
			}
			if ($this->_preset == self::SCALE && empty($this->_scale)) {
				return "error";
			}
			if (($this->_preset == self::RX || $this->_preset == self::RY ||
				$this->_preset == self::RZ) && empty($this->_angle)) {
				return "error";
			}
			if ($this->_preset == self::TRANSLATION && empty($this->_vtc)) {
				return "error";
			}
			if ($this->_preset == self::PROJECTION && (empty($this->_fov) ||
				empty($this->_radio) || empty($this->_near)
				|| empty($this->_far))) {
					return "error";
			}
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
					$tmp[$i + $j] += $this->_matrix[$i + 0] *
						$rhs->_matrix[$j + 0];
					$tmp[$i + $j] += $this->_matrix[$i + 1] *
						$rhs->_matrix[$j + 4];
					$tmp[$i + $j] += $this->_matrix[$i + 2] *
						$rhs->_matrix[$j + 8];
					$tmp[$i + $j] += $this->_matrix[$i + 3] *
						$rhs->_matrix[$j + 12];
				}
			}
			$clone = new Matrix();
			$clone->_matrix = $tmp;
			return $clone;
		}

		private function translation()
		{
			$this->identity(1);
			$this->_matrix[3] = $this->_vtc->_x;
			$this->_matrix[7] = $this->_vtc->_y;
			$this->_matrix[11] = $this->_vtc->_z;
		}

		private function rotation_x() {
			$this->identity(1);
			$this->_matrix[0] = 1;
			$this->_matrix[5] = cos($this->_angle);
			$this->_matrix[6] = -sin($this->_angle);
			$this->_matrix[9] = sin($this->_angle);
			$this->_matrix[10] = cos($this->_angle);
		}

		private function rotation_y() {
			$this->identity(1);
			$this->_matrix[0] = cos($this->_angle);
			$this->_matrix[2] = sin($this->_angle);
			$this->_matrix[5] = 1;
			$this->_matrix[8] = -sin($this->_angle);
			$this->_matrix[10] = cos($this->_angle);
		}

		private function rotation_z() {
			$this->identity(1);
			$this->_matrix[0] = cos($this->_angle);
			$this->_matrix[1] = -sin($this->_angle);
			$this->_matrix[4] = sin($this->_angle);
			$this->_matrix[5] = cos($this->_angle);
			$this->_matrix[10] = 1;
		}

		private function projection() {
			$this->identity(1);
			$this->_matrix[5] = 1 / tan(0.5 * deg2rad($this->_fov));
			$this->_matrix[0] = $this->_matrix[5] / $this->_ratio;
			$this->_matrix[10] = -1 * (-$this->_near - $this->_far) /
				($this->_near - $this->_far);
			$this->_matrix[14] = -1;
			$this->_matrix[11] = (2 * $this->_near * $this->_far) /
				($this->_near - $this->_far);
			$this->_matrix[15] = 0;
		}

		private function identity($scale)
		{
			$this->_matrix[0] = $scale;
			$this->_matrix[5] = $scale;
			$this->_matrix[10] = $scale;
			$this->_matrix[15] = 1;
		}

		public function transformVertex(Vertex $vtx) {
			$tmp = array();
			$tmp['x'] = ($vtx->_x * $this->_matrix[0]) +
			($vtx->_y * $this->_matrix[1]) + ($vtx->_z * $this->_matrix[2]) +
			($vtx->_w * $this->_matrix[3]);
			$tmp['y'] = ($vtx->_x * $this->_matrix[4]) +
			($vtx->_y * $this->_matrix[5]) + ($vtx->_z * $this->_matrix[6]) +
			($vtx->_w * $this->_matrix[7]);
			$tmp['z'] = ($vtx->_x * $this->_matrix[8]) +
			($vtx->_y * $this->_matrix[9]) + ($vtx->_z * $this->_matrix[10]) +
			($vtx->_w * $this->_matrix[11]);
			$tmp['w'] = ($vtx->_x * $this->_matrix[11]) +
			($vtx->_y * $this->_matrix[13]) + ($vtx->_z * $this->_matrix[14]) +
			($vtx->_w * $this->_matrix[15]);
			$tmp['color'] = $vtx->_color;
			$vertex = new Vertex($tmp);
			return $vertex;
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
				$this->_matrix[0], $this->_matrix[1],
					$this->_matrix[2], $this->_matrix[3],
				$this->_matrix[4], $this->_matrix[5],
					$this->_matrix[6], $this->_matrix[7],
				$this->_matrix[8], $this->_matrix[9],
					$this->_matrix[10], $this->_matrix[11],
				$this->_matrix[12], $this->_matrix[13],
					$this->_matrix[14], $this->_matrix[15])));
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
