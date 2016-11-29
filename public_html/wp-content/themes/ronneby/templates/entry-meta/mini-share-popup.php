<?php
	global $dfd_ronneby;
	$data_title = get_the_title();
	$data_link = get_permalink();
?>
<div class="dfd-share-popup-wrap">
	<a href="#" class="dfd-share-popup"><i class="dfd-icon-network"></i></a>
	<ul class="entry-share-popup" data-directory="<?php echo get_template_directory_uri(); ?>"<?php /* style="display: none;" */?>>
		<?php if(!isset($dfd_ronneby['single_enable_facebook']) || $dfd_ronneby['single_enable_facebook']) : ?>
		<li>
			<a class="entry-share-link-facebook" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>" href="#">
				<i class="soc_icon-facebook"></i>
			</a>
			<span class="box-name"><?php _e('Facebook', 'dfd') ?></span>
		</li>
		<?php endif; ?>
		<?php if(!isset($dfd_ronneby['single_enable_twitter']) || $dfd_ronneby['single_enable_twitter']) : ?>
		<li>
			<a class="entry-share-link-twitter" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>" href="#">
				<i class="soc_icon-twitter-2"></i>
			</a>
			<span class="box-name"><?php _e('Twitter', 'dfd') ?></span>
		</li>
		<?php endif; ?>
		<?php if(!isset($dfd_ronneby['single_enable_google_plus']) || $dfd_ronneby['single_enable_google_plus']) : ?>
		<li>
			<a class="entry-share-link-googleplus" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>" href="#">
				<i class="soc_icon-google"></i>
			</a>
			<span class="box-name"><?php _e('Google +', 'dfd') ?></span>
		</li>
		<?php endif; ?>
		<?php if(!isset($dfd_ronneby['single_enable_linkedin']) || $dfd_ronneby['single_enable_linkedin']) : ?>
		<li>
			<a class="entry-share-link-linkedin" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>" href="#">
				<i class="soc_icon-linkedin"></i>
			</a>
			<span class="box-name"><?php _e('LinkedIN', 'dfd') ?></span>
		</li>
		<?php endif; ?>
		<?php if(!isset($dfd_ronneby['single_enable_pinterest']) || $dfd_ronneby['single_enable_pinterest']) : ?>
		<li>
			<a class="entry-share-link-pinterest" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>" href="#">
				<i class="soc_icon-pinterest"></i>
			</a>
			<span class="box-name"><?php _e('Pinterest', 'dfd') ?></span>
		</li>
		<?php endif; ?>
	</ul>
</div>