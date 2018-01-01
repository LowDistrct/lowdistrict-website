<?php
function includePopularTags() {
	$tags = sqlQueryArray("SELECT * FROM `tags` ORDER BY `clicks` DESC LIMIT 0,14");
	foreach ($tags as $tag) {
		ob_start();
		?>
		<a href="search.php?tag=<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></a>
		<?php
		echo ob_get_clean();
	}
}
?>
