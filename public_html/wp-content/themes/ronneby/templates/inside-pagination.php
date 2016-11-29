<?php
	$prev_post = get_previous_post();
	$next_post = get_next_post();
	
	$prev_post_link = $prev_post_title = $prev_post_date = $prev_post_thumb = $next_post_link = $next_post_title = $next_post_date = $next_post_thumb = false;
	
	if(!empty($prev_post) && is_object($prev_post)) {
		$prev_post_link = get_permalink($prev_post->ID);
		$prev_post_title = get_the_title($prev_post->ID);
		$prev_post_date = mysql2date('d F Y', $prev_post->post_date, false);
		$prev_comments = wp_count_comments($prev_post->ID);
		$prev_comments_count = (isset($prev_comments->approved)) ? $prev_comments->approved : 0;
		$prev_post_thumb = get_the_post_thumbnail($prev_post->ID, array(95,95));
		if(empty($prev_post_thumb)) $prev_post_thumb = prev_next_post_format_icon($prev_post->ID);
	}
	
	if(!empty($next_post) && is_object($next_post)) {
		$next_post_link = get_permalink($next_post->ID);
		$next_post_title = get_the_title($next_post->ID);
		$next_post_date = mysql2date('d F Y', $next_post->post_date, false);
		$next_comments = wp_count_comments($next_post->ID);
		$next_comments_count = (isset($next_comments->approved)) ? $next_comments->approved : 0;
		$next_post_thumb = get_the_post_thumbnail($next_post->ID, array(95,95));
		if(empty($next_post_thumb)) $next_post_thumb = prev_next_post_format_icon($next_post->ID);
	}
?>
<?php
/*
<ul class="inner-nav">
	<?php if(!empty($prev_post_link)) : ?>
		<li class="inner-nav-prev"><a href="<?php echo esc_url($prev_post_link); ?>"><?php echo $prev_post_title; ?></a></li>
	<?php endif; ?>
	<?php if(!empty($next_post_link)) : ?>
		<li class="inner-nav-next"><a href="<?php echo esc_url($next_post_link); ?>"><?php echo $next_post_title; ?></a></li>
	<?php endif; ?>
</ul>
*/
?>
<div class="dfd-controls mobile-hide">
	<?php if(!empty($prev_post_link)) : ?>
		<a href="<?php echo esc_url($prev_post_link); ?>" class="page-inner-nav nav-prev">
			<div class="dfd-controler prev"><span><?php _e('Prev','dfd'); ?></span></div>
			<div class="pagination-title">
				<div class="thumb prev">
					<?php echo $prev_post_thumb; ?>
					<span class="entry-comments"><?php echo $prev_comments_count ?></span>
				</div>
				<div class="dfd-vertical-aligned">
					<div class="box-name"><?php echo $prev_post_title; ?></div>
					<div class="subtitle"><?php echo $prev_post_date; ?></div>
				</div>
			</div>
		</a>
	<?php endif; ?>
	<?php if(!empty($next_post_link)) : ?>
		<a href="<?php echo esc_url($next_post_link); ?>" class="page-inner-nav nav-next">
			<div class="dfd-controler next"><span><?php _e('Next','dfd'); ?></span></div>
			<div class="pagination-title">
				<div class="thumb next">
					<?php echo $next_post_thumb; ?>
					<span class="entry-comments"><?php echo $next_comments_count ?></span>
				</div>
				<div class="dfd-vertical-aligned">
					<div class="box-name"><?php echo $next_post_title; ?></div>
					<div class="subtitle"><?php echo $next_post_date; ?></div>
				</div>
			</div>
		</a>
	<?php endif; ?>
</div>