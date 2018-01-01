<?php
function blogDisplay($post, $photo) {
	$postid = $post['id'];
	$photoid = $photo['id'];
	$title = $post['title'];
	$photographer = $photo['first_name']." ".$photo['last_name'];
	$date = getRelativeDateFormat(strtotime($post['date']));
	$location = $post['loc_city'].', '.$post['loc_state'];
	$flag = strtolower($post['loc_country']);
	$description = str_replace("\n", "<br>", $post['description']);
	ob_start();
?>
<div class="blog-container">
	<h1 class="photo"><a href="/post.php?id=<?php echo $postid; ?>"><?php echo $title; ?></a></h1>
	<ul class="cf">
		<li>by <a href="/profile.php?id=<?php echo $photo['id']; ?>"><?php echo $photographer; ?></a></li>
		<li class="clock right"><?php echo $date; ?></li>
	</ul>
	<a href="/post.php?id=<?php echo $postid; ?>">
		<div class="cover-index" bg="/images/posts/<?php echo $postid; ?>/cover_sd.jpg"></div>
		<div class="cover-blog" bg="/images/posts/<?php echo $postid; ?>/thumb_blog.jpg"></div>
	</a>
	<ul class="cf">
		<li><?php echo $location; ?></li>
		<li class="flag" bg="/images/flags/<?php echo $flag; ?>.png"></li>
	</ul>
	<p><?php echo $description; ?></p>
	<div class="button-container">
		<a class="button" href="/post.php?id=<?php echo $postid; ?>">Read More</a>
	</div>
</div>
<?php
	echo ob_get_clean();
}
?>
