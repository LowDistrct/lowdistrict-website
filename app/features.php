<?php
include "/php/core.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php if (isset($_GET['make'])) { echo $_GET['make']." "; if (isset($_GET['model'])) { echo $_GET['model']." "; }} ?>Features</title>
	<?php include("/includes/global/head.php"); ?>
	<style media="screen">
		<?php include("/css/features.css"); ?>
	</style>
</head>
<body>
<div class="wrapper">

	<!-- Navigation -->
	<?php include("/includes/global/nav_black.php"); ?>
	<?php include("/includes/global/social_bar.php"); ?>

	<!-- Make Emblems -->
	<?php
		if (!isset($_GET['make'])) {
			include("/includes/features/make_emblems.php");
		}
		else {
			include("/includes/features/model_selection.php");
		}
	?>

	<div class="blog-list">
		<?php
			include("/includes/templates/blog.php");
			$posts = sqlQueryArray("SELECT * FROM `posts` WHERE `car_make` = '$_GET[make]' ORDER BY `car_model` ASC");
			foreach ($posts as $post) {
				$photo = sqlQueryArray("SELECT * FROM `photographers` WHERE (`id` = $post[shot_by]) LIMIT 0,1");
				blogDisplay($post, $photo[0]);
			}
		?>
	</div>

	<!-- Footer -->
	<?php include("/includes/global/footer.php"); ?>

	<!-- Scripts -->
	<?php include("/includes/global/scripts.php"); ?>
	<script type="text/javascript"></script>

</div>
</body>
</html>
