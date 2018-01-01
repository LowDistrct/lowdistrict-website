<?php function includeMakeEmblems() { ?>
	<div class="make-emblems-container">
		<?php
		$makesSQL = sqlQueryArray("SELECT * FROM `posts` ORDER BY `car_make` ASC");
		$makes = array();
		foreach ($makesSQL as $make) {
			if (!in_array($make['car_make'], $makes)) {
				array_push($makes, $make['car_make']);
			}
		}
		foreach ($makes as $make) { ob_start(); ?>
			<a href="/features.php?make=<?php echo $make; ?>" bg="/images/car_make/dark/<?php echo $make; ?>.png"></a>
		<?php echo ob_get_clean(); } ?>
	</div>
<?php } ?>
