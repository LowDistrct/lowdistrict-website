<?php
function tagDisplay($tag) {
	ob_start();
?>
<a href="search.php?tag=<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></a>
<?php
	echo ob_get_clean();
}
?>
