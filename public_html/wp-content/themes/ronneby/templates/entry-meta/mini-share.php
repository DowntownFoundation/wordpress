<?php
	$data_title = get_the_title();
	$data_link = get_permalink();
?><div class="share-cover">
    <div class="entry-share">
	    <ul class="entry-share-popup" data-directory="<?php echo get_template_directory_uri(); ?>"<?php /* style="display: none;" */?>>
		    <li>
			    <a class="entry-share-link-facebook" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>" href="#">
					<span class="box-name"><?php _e('Facebook', 'dfd'); ?></span>
			    </a>
		    </li>
		    <li>
			    <a class="entry-share-link-twitter" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>" href="#">
					<span class="box-name"><?php _e('Twitter', 'dfd'); ?></span>
			    </a>
		    </li>
		    <li>
			    <a class="entry-share-link-googleplus" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>" href="#">
					<span class="box-name"><?php _e('Google Plus', 'dfd'); ?></span>
			    </a>
		    </li>
		    <li>
				<a class="entry-share-link-linkedin" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>" href="#">
					<span class="box-name"><?php _e('LinkedIN', 'dfd'); ?></span>
				</a>
			</li>
	    </ul>
    </div>
</div>
