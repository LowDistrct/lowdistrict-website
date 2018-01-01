<?php
function includePopularPosts() {
	$posts = sqlQueryArray("SELECT * FROM `posts` ORDER BY `views` DESC LIMIT 0,6");
	foreach ($posts as $post) {
		ob_start();
		?>
		<a href="/post.php?id=<?php echo $post['id']; ?>" bg="/images/posts/<?php echo $post['id']; ?>/thumb_home.jpg">
			<?php if($post['video_id'] != null) { ?><img src="images/sprites/play_button.png"><?php } ?>
		</a>
		<?php
		echo ob_get_clean();
	}
}
?>
