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
?>
