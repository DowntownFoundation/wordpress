<?php
	$data_title = get_the_title();
	$data_link = get_permalink();
?>
<div class="dfd-single-share-fixed" data-directory="<?php echo get_template_directory_uri(); ?>">
    <ul>
	    <li class="entry-share-link-facebook" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>"></li>
	    <li class="entry-share-link-twitter" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>"></li>
	    <li class="entry-share-link-googleplus" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>"></li>
	    <li class="entry-share-link-linkedin" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>"></li>
    </ul>
</div>