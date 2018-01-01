<div class="pages-container">
	<?php for ($i = 1; $i <= $pages; $i++) { ?>
		<?php if ($i == $page) { ?>
			<a class="page-current"><?php echo $i; ?></a>
		<?php } else { ?>
			<a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
		<?php } ?>
	<?php } ?>
</div>
