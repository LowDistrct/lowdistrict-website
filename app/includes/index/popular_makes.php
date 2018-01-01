<?php
function includePopularMakes() {
	$posts = sqlQueryArray("SELECT * FROM `posts`");
	$makes = array();
	foreach ($posts as $post) {
		if (isset($makes[$post['car_make']])) {
			$count = intval(explode(':', $makes[$post['car_make']])[0]) + 1;
			$countStr = (string) $count;
			$len = strlen($countStr);
			for ($j = $len; $j < 5; $j++) {
				$countStr = "0".$countStr;
			}
			$makes[$post['car_make']] = $countStr.':'.$post['car_make'];
		}
		else {
			$makes[$post['car_make']] = '000001:'.$post['car_make'];
		}
	}
	rsort($makes);
	$i = 0;
	foreach ($makes as $key=>$value) {
		if ($i < 6) {
			$i++;
		}
		else {
			break;
		}
?>
<a href="blog.php?make=<?php echo explode(':', $value)[1]; ?>">
	<img src="images/car_make/dark/<?php echo strtolower(explode(':', $value)[1]); ?>.png" alt="<?php echo strtolower(explode(':', $value)[1]); ?>">
</a>
<?php
	}
}
?>
