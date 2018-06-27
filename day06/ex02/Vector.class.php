<?php
	require_once 'Vertex.class.php';

	class Vector {
		private $_x;
		private $_y;
		private $_z;
		private $_w = 0.0;
		static $verbose = false;

		public function __construct(array $vect) {
			if (isset($vect['orig'])) {
				$orig = new Vertex( array(
					'x' => $vect['orig']->_x,
					'y' => $vect['orig']->_y,
					'z' => $vect['orig']->_z) );
			} else if (!isset($orig)) {
				$orig = new Vertex( array(
					 'x' => 0.0, 'y' => 0.0, 'z' => 0.0 , 'w' => 1.0) );
			}
			if (isset($vect['dest'])) {
				$this->_x = $vect['dest']->_x - $vect['orig']->_x;
				$this->_y = $vect['dest']->_y - $vect['orig']->_y;
				$this->_z = $vect['dest']->_z - $vect['orig']->_z;
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
			return ($ret = sprintf(
				"Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )",
				$this->_x, $this->_y, $this->_z, $this->_w) );
		}

		public function doc() {
			if ($str = file_get_contents('Vector.doc.txt')) {
				echo "$str";
			}
			else {
				echo "Error: .doc file doesn't exist.\n";
			}
		}

		public function magnitude() {
			$magn = (float)sqrt(
				($this->_x - $orig->x) ** 2 +
				($this->_y - $orig->y) ** 2 +
				($this->_z - $orig->z) ** 2
			);
			if ($magn == 1) {
				return ("norm");
			} else {
				return ($magn);
			}
		}

		public function normalize() {
			$len = $this->magnitude();
			if ($len == 1) {
				return clone $this;
			}
			$norm = new Vector(array('dest' => new Vertex(array(
				'x' => $this->_x / $len,
				'y' => $this->_y / $len,
				'z' => $this->_z / $len
			))));
			return ($norm);
		}

		public function add(Vector $rhs) {
			$add = new Vector(array('dest' => new Vertex(array(
				'x' => $this->_x + $rhs->_x,
				'y' => $this->_y + $rhs->_y,
				'z' => $this->_z + $rhs->_z
			))));
			return ($add);
		}

		public function sub(Vector $rhs) {
			$sub = new Vector(array('dest' => new Vertex(array(
				'x' => $this->_x - $rhs->_x,
				'y' => $this->_y - $rhs->_y,
				'z' => $this->_z - $rhs->_z
			))));
			return ($sub);
		}

		public function opposite() {
			$opp = new Vector(array('dest' => new Vertex(array(
				'x' => $this->_x * (-1),
				'y' => $this->_y * (-1),
				'z' => $this->_z * (-1)
			))));
			return ($opp);
		}

		public function scalarProduct($k) {
			$scl = new Vector(array('dest' => new Vertex(array(
				'x' => $this->_x * $k,
				'y' => $this->_y * $k,
				'z' => $this->_z * $k
			))));
			return ($scl);
		}

		public function dotProduct(Vector $rhs) {
			$dot = (float)(
				$this->_x * $rhs->_x +
				$this->_y * $rhs->_y +
				$this->_z * $rhs->_z
			);
			return ($dot);
		}

		public function crossProduct(Vector $rhs) {
			$cross = new Vector(array('dest' => new Vertex(array(
				'x' => $this->_y * $rhs->_z - $this->_z * $rhs->_y,
				'y' => $this->_z * $rhs->_x - $this->_x * $rhs->_z,
				'z' => $this->_x * $rhs->_y - $this->_y * $rhs->_x
			))));
			return ($cross);
		}

		public function cos(Vector $rhs) {
			if ($this->magnitude() == "norm"|| $rhs->magnitude() == "norm") {
					return (0);
			} else {
				$multilen = $this->magnitude() * $rhs->magnitude();
				return ($this->dotProduct($rhs) / $multilen);
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
	}
?>
