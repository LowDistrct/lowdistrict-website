<?php
function teamDisplay($photo) {
	$position;
	if ($photo['position'] == 0) {
		$position = "Photographer";
	}
	if ($photo['position'] == 1) {
		$position = "Photographer / Videographer";
	}
	if ($photo['position'] == 2) {
		$position = "Videographer";
	}
	ob_start();
?>
<a class="cf" href="/profile.php?id=<?php echo $photo['id']; ?>">
	<img src="/images/profile/<?php echo $photo['id']; ?>.jpg" alt="profile_pic">
	<h1><?php echo $photo['first_name'].' '.$photo['last_name']; ?></h1>
	<span><?php echo $position; ?></span>
	<span><?php echo $photo['loc_city'].', '.$photo['loc_state']; ?><img src="/images/flags/<?php echo strtolower($photo['loc_country']); ?>.png" alt="country"></span>
</a>
<?php
	echo ob_get_clean();
}
?>
