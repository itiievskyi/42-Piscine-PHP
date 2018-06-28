<?php
	class NightsWatch implements IFighter {
		private $_fight;

		public function recruit ($meat) {
			if ($meat instanceof IFighter) {
				$_fight .= $meat->fight();
			}
		}

		public function fight() {
			print($_fight);
		}
	}
?>
