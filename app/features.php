<?php
include "/php/core.php";
include "/includes/features/include.php";
include "/includes/templates/blog.php";
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
		if (isset($_GET['make'])) {
			includeModelSelection();
		}
		else {
			includeMakeEmblems();
		}
	?>

	<?php
		if (isset($_GET['make'])) {
			if (isset($_GET['model'])) {
				includeBlogList("SELECT * FROM `posts` WHERE `car_make` = '$_GET[make]' AND `car_model` = '$_GET[model]' ORDER BY `car_model` ASC");
			}
			else {
				includeBlogList("SELECT * FROM `posts` WHERE `car_make` = '$_GET[make]' ORDER BY `car_model` ASC");
			}
		}
		else {

			// ADD TITLES TO BLOG_LIST (REFRESH PAGE)

			?><div style="padding: 10px 0px; background-color: #EDEDED;">
			<?php
				includeBlogListDiv("SELECT * FROM `posts` ORDER BY `views` DESC LIMIT 0,4", "Most Popular", "from most views to least");
			?></div><?php
			includeBlogListDiv("SELECT * FROM `posts` WHERE (`category` <= 1) ORDER BY `id` DESC LIMIT 0,4", "Photoshoots", "from newest to oldest");
			includeBlogListDiv("SELECT * FROM `posts` WHERE (`category` >= 1) ORDER BY `id` DESC LIMIT 0,4", "Videoshoots", "from newest to oldest");
			includeFindPhotographer();
		}
	?>

	<!-- Footer -->
	<?php include("/includes/global/footer.php"); ?>

	<!-- Scripts -->
	<?php include("/includes/global/scripts.php"); ?>
	<script type="text/javascript"></script>

</div>
</body>
</html>
