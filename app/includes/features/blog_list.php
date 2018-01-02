<?php
function includeBlogList($sql) {
	ob_start();
	?>
	<div class="blog-list">
		<?php
			$posts = sqlQueryArray($sql);
			foreach ($posts as $post) {
				$photo = sqlQueryArray("SELECT * FROM `photographers` WHERE (`id` = $post[shot_by]) LIMIT 0,1");
				blogDisplay($post, $photo[0]);
			}
		?>
	</div>
	<?php
	echo ob_get_clean();
}
function includeBlogListDiv($sql, $title, $span) {
	ob_start();
	?>
	<div class="blog-list">
		<div class="header">
			<h1><?php echo $title; ?></h1>
			<span><?php echo $span; ?></span>
		</div>
		<?php
			$posts = sqlQueryArray($sql);
			foreach ($posts as $post) {
				$photo = sqlQueryArray("SELECT * FROM `photographers` WHERE (`id` = $post[shot_by]) LIMIT 0,1");
				blogDisplay($post, $photo[0]);
			}
		?>
		<div class="view-more">
			<a href="#">View All</a>
		</div>
	</div>
	<?php
	echo ob_get_clean();
}
?>
