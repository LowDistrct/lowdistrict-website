<?php
function postDisplay($post) {
	ob_start();
?>
<a href="/post.php?id=<?php echo $post['id']; ?>" bg="/images/posts/<?php echo $post['id']; ?>/thumb_home.jpg">
	<?php if($post['video_id'] != null) { ?><img src="images/sprites/play_button.png"><?php } ?>
</a>
<?php
	echo ob_get_clean();
}
?>
