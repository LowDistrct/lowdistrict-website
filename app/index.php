<?php

include "/php/core.php";

include "/includes/index/include.php";

// Page Engine
$page = isset($_GET['page'])?$_GET['page']:1;
$numPerPage = 8;
$pages = ceil(sqlQueryNum("SELECT * FROM `posts`") / $numPerPage);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<?php include("/includes/global/head.php"); ?>
	<style media="screen">
		<?php include("/css/index.css"); ?>
	</style>
</head>
<body>
<div class="wrapper">

	<!-- Navigation -->
	<?php include("/includes/global/nav_white.php"); ?>
	<?php include("/includes/global/social_bar.php"); ?>

	<!-- Full Screen Slider -->
	<?php includeSlider(); ?>

	<!-- Who Are We -->
	<?php includeIntro(); ?>

	<!-- Page Selector -->
	<?php include("/includes/global/pages.php"); ?>

	<div class="content cf">
		<div class="main-container">
			<h1 class="banner">MOST RECENT</h1>
			<?php
				include "/includes/templates/blog.php";
				$posts = sqlQueryArray("SELECT * FROM `posts` ORDER BY `id` DESC LIMIT ".(($page - 1) * $numPerPage).",$numPerPage");
				foreach ($posts as $post) {
					$photo = sqlQueryArray("SELECT * FROM `photographers` WHERE (`id` = $post[shot_by]) LIMIT 0,1");
					blogDisplay($post, $photo[0]);
				}
			?>
		</div>
		<div class="sidebar">
			<!-- #region SEARCH BAR -->
			<form action="/search.php" method="get">
				<input type="text" name="q" placeholder="vehicle, wheels, location, etc...">
				<input type="submit" value="">
			</form>
			<!-- #endregion -->
			<!-- #region Popular Tags -->
			<h1>Popular Tags</h1>
			<div class="popular-tags">
				<?php includePopularTags(); ?>
			</div>
			<!-- #endregion -->
			<!-- #region Popular Posts -->
			<h1>Popular Posts</h1>
			<div class="popular-posts">
				<?php includePopularPosts(); ?>
			</div>
			<div class="view-all">
				<a href="/seeall.php?index=0&id=0&i">View All</a>
			</div>
			<!-- #endregion -->
			<!-- #region Latest Recruits -->
			<h1>Latest Recruits</h1>
			<div class="latest-recruits">
				<?php includeLatestRecruits(); ?>
			</div>
			<div class="view-all">
				<a href="/seeall.php?index=1&id=4&i">View All</a>
			</div>
			<!-- #endregion -->
			<!-- #region Popular Makes -->
			<h1>Popular Makes</h1>
			<div class="popular-makes cf">
				<?php includePopularMakes(); ?>
			</div>
			<div class="view-all">
				<a href="/blog.php">View All</a>
			</div>
			<!-- #endregion -->
		</div>
	</div>

	<!-- Page Selector -->
	<?php include("/includes/global/pages.php"); ?>

	<!-- Footer -->
	<?php include("/includes/global/footer.php"); ?>

	<!-- Scripts -->
	<?php include("/includes/global/scripts.php"); ?>
	<script type="text/javascript">
		<?php include("/js/index.js"); ?>
	</script>

</div>
</body>
</html>
