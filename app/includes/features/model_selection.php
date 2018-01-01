<div class="model-selection">
	<div class="emblem" bg="/images/car_make/dark/<?php echo $_GET['make']; ?>.png"></div>
	<?php if (!isset($_GET['model'])) { ?>
	<div class="model-list">
		<?php
		$modelsSQL = sqlQueryArray("SELECT * FROM `posts` WHERE `car_make` = '$_GET[make]' ORDER BY `car_model` ASC");
		$models = array();
		foreach ($modelsSQL as $model) {
			if (!in_array($model['car_model'], $models)) {
				array_push($models, $model['car_model']);
			}
		}
		foreach ($models as $model) { ob_start(); ?>
			<a href="/features.php?make=<?php echo $_GET['make']; ?>&model=<?php echo $model; ?>"><?php echo $model; ?></a>
		<?php echo ob_get_clean(); } ?>
	</div>
	<?php } ?>
</div>
