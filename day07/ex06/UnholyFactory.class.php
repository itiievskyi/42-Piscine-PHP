<?php

	class UnholyFactory {
		private $_templates;

		public function __construct() {
			$this->_templates = array();
		}

		public function absorb($meat) {
			if ($meat instanceof Fighter) {
				$this->$name = $meat->__tostring();
				if (in_array($this->$name, $this->_templates) == false) {
					print("(Factory absorbed a fighter of type " .
					$this->$name . ")" . PHP_EOL);
					$this->_templates[get_class($meat)] = $this->$name;
				} else {
					print("(Factory already absorbed a fighter of type " .
					$this->$name . ")" . PHP_EOL);
				}
			} else {
				print("(Factory can't absorb this, it's not a fighter)"
				. PHP_EOL);
			}
		}

		public function fabricate($rf) {
			if (in_array($rf, $this->_templates) == false) {
				print("(Factory hasn't absorbed any fighter of type $rf)\n");
				return NULL;
			} else {
				print("(Factory fabricates a fighter of type $rf)\n");
				$this->$key = array_search($rf, $this->_templates);
				$this->$classname = $var.$this->$key;
				return(new $this->$classname());
			}
		}
	}

?>
