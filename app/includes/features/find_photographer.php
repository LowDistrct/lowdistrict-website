<?php
class FindArea {
	private function getLocations($items) {
		$loc = array();
		foreach ($items as $photo) {
			$co = $photo['loc_country'];
			$st = $photo['loc_state'];
			$ci = $photo['loc_city'];
			if (!isset($loc[$co])) {
				$loc[$co] = array();
			}
			if (!isset($loc[$co][$st])) {
				$loc[$co][$st] = array();
			}
			if (!isset($loc[$co][$st][$ci])) {
				$loc[$co][$st][$ci] = 0;
			}
			$loc[$co][$st][$ci] += 1;
		}
		$oldOrder = array();
		foreach ($loc as $co=>$val) {
			$countStr = (string) FindArea::countCountry($loc, $co);
			$len = strlen($countStr);
			for ($j = $len; $j < 5; $j++) {
				$countStr = "0".$countStr;
			}
			$oldOrder[] = $countStr."-".$co;
		}
		rsort($oldOrder);
		$newOrder = array();
		foreach ($oldOrder as $key=>$value) {
			$co = explode("-", $value)[1];
			$newOrder[$co] = $loc[$co];
		}
		return $newOrder;
	}
	static function getPhotographers() {
		$q = sqlQueryArray("SELECT * FROM `photographers` WHERE (standing = 2) ORDER BY loc_country, loc_state, loc_city");
		return FindArea::getLocations($q);
	}
	static function getFeatures() {
		$q = sqlQueryArray("SELECT * FROM `posts` ORDER BY loc_country, loc_state, loc_city");
		return FindArea::getLocations($q);
	}
	static function countCountry($loc, $country) {
		$output = 0;
		foreach ($loc[$country] as $st=>$val) {
			$output += FindArea::countState($loc, $country, $st);
		}
		return $output;
	}
	static function countState($loc, $country, $state) {
		$output = 0;
		foreach ($loc[$country][$state] as $value) {
			$output += $value;
		}
		return $output;
	}

}
function includeFindPhotographer() {
	?>
	<div class="find-features">
		<div class="header">
			<h1>FIND YOUR AREA</h1>
		</div>
		<div class="list">
			<?php
			$loc = FindArea::getFeatures();
			foreach ($loc as $co=>$coarray) {
				echo '<span class="country">'.$co.'<img src="images/flags/'.strtolower($co).'.png" class="flag"></span>';
				foreach ($coarray as $st=>$starray) {
					echo '<span class="state"><a href="seeall.php?index=0&id=3&data='.$st.':'.$co.'">'.$st.' ('.FindArea::countState($loc, $co, $st).')</a></span>';
					foreach ($starray as $ci=>$value) {
						echo '<span class="city">'.$ci.'</span>';
					}
				}
			}
			?>
		</div>
	</div>
<?php } ?>
