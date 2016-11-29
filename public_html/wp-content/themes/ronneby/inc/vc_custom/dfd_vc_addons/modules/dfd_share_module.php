<?php
/*
* Add-on Name: Share Module
*/
if(!class_exists('Dfd_Share_Module')) 
{
	class Dfd_Share_Module{
		function __construct(){
			add_action('init',array($this,'dfd_share_module_init'));
			add_shortcode('dfd_share_module',array($this,'dfd_share_module_shortcode'));
		}
		function dfd_share_module_init(){
			if(function_exists('vc_map')) {
				vc_map(
					array(
						'name' => __('Share module','dfd'),
						'base' => 'dfd_share_module',
						'class' => 'vc_info_banner_icon',
						'icon' => 'vc_icon_info_banner',
						//'deprecated' => '4.6',
						'category' => __('Ronneby 1.0','dfd'),
						'description' => __('Displays social share','dfd'),
						'params' => array(
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable Facebook share option','dfd'),
								'param_name' => 'enable_facebook_share',
								'value' => array('Yes, please' => 'yes'),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable Twitter share option','dfd'),
								'param_name' => 'enable_twitter_share',
								'value' => array('Yes, please' => 'yes'),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable Google Plus share option','dfd'),
								'param_name' => 'enable_googleplus_share',
								'value' => array('Yes, please' => 'yes'),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable Linked-IN share option','dfd'),
								'param_name' => 'enable_linkedin_share',
								'value' => array('Yes, please' => 'yes'),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable Pinterest share option','dfd'),
								'param_name' => 'enable_pinterest_share',
								'value' => array('Yes, please' => 'yes'),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Module style','dfd'),
								'param_name' => 'module_style',
								"value" => array(
									__('Simple','dfd') => 'dfd-default',
									__('Colored background on hover','dfd') => 'dfd-background-hover',
									__('Colored background','dfd') => 'dfd-default-background'
								),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Text alignment','dfd'),
								'param_name' => 'text_panel_alignment',
								"value" => array(
									__('Center','dfd') => "text-center",
									__('Left','dfd') => "text-left",
									__('Right','dfd') => "text-right"
								),
								'dependency' => array('element' => 'module_style','value' => array('dfd-default')),
							),
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Custom CSS Class', 'dfd'),
								'param_name' => 'el_class',
								'value' => '',
								'description' => __('Custom CSS class', 'dfd'),
								
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => __( 'Animation', 'dfd' ),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
								'description' => __( '', 'dfd' ),
								'group'       => 'Animation Settings',
							),
						),
					)
				);
			}
		}
		// Shortcode handler function
		function dfd_share_module_shortcode($atts){
			$output = $enable_facebook_share = $enable_twitter_share = $enable_google_plus_share = $enable_linkedin_share = $enable_pinterest_share = $module_style = $text_panel_alignment = $el_class = $share_html  = $module_animation = $animate = $animation_data = '';
			
			$data_link = get_site_url();
			$data_title = $blog_title = get_bloginfo('name');

			$unique_id = uniqid('dfd_share_');
			
			extract(shortcode_atts( array(
				'enable_facebook_share' => '',
				'enable_twitter_share' => '',
				'enable_googleplus_share' => '',
				'enable_linkedin_share' => '',
				'enable_pinterest_share' => '',
				'module_style' => 'dfd-default',
				'text_panel_alignment' => 'text-center',
				'module_animation' => '',
				'el_class'=>'',
			),$atts));
			
			$share_data = array(
				'facebook' => __('Facebook', 'dfd'),
				'twitter' => __('Twitter', 'dfd'),
				'googleplus' => __('Google plus', 'dfd'),
				'linkedin' => __('LinkedIN', 'dfd'),
				'pinterest' => __('Pinterest','dfd'),
			);

			if ( ! ($module_animation == '')){
				$animate .= ' cr-animate-gen';
				$animation_data .= 'data-animate-item = ".module-entry-share-links-list > li" data-animate-type = "'.$module_animation.'" ';
			}
			
			ob_start();
			echo '<div class="dfd-shar-module-cover">';
				echo '<div class="dfd-share-module '.esc_attr($module_style).' '.esc_attr($el_class).' '.$animate.'" '.$animation_data.'>';
					echo '<div class="module module-entry-share" id="'. esc_attr($unique_id) .'">';
						echo '<ul class="module-entry-share-links-list" data-directory="'. get_template_directory_uri() .'">';
							foreach($share_data as $key => $value) {
								$social_network = 'enable_'.$key.'_share';
								if(strcmp($module_style, 'dfd-default') === 0) {
									$link_text = '<span class="chaffle" data-lang="en">'.$value.'</span>';
								} else {
									$link_text = '<span>'. $value .'</span>';
								}
								if($$social_network) {
									echo '<li class="'.esc_attr($text_panel_alignment).'">';
										echo '<a class="module-entry-share-link-'.esc_attr($key).' feature-title" data-title="'. esc_attr($data_title) .'" data-url="'. esc_url($data_link) .'" data-media="" href="#">'.$link_text.'</a>';
									echo '</li>';
								}
							}
						echo '</ul>';
					echo '</div>';
				echo '</div>';
				?>
				<script type="text/javascript">
					(function($){
						"use strict";
						$(document).ready(function() {
							var $share_container = $('#<?php echo esc_js($unique_id); ?> .module-entry-share-links-list li');

							if ($share_container.length  > 0) {
								$('.module-entry-share-link-facebook', $share_container).sharrre({
									share: {
										facebook: true
									},
									template: '<a href="#"><i class="soc_icon-facebook"></i></a>',
									enableHover: false,
									enableCounter: false,
									urlCurl: $share_container.data('directory') + '/inc' + '/sharrre.php',

									click: function (api, options) {
										api.simulateClick();
										api.openPopup('facebook');
									}
								});


								$('.module-entry-share-link-twitter', $share_container).sharrre({
									share: {
										twitter: true
									},
									template: '<a href="#" class="twitter"><i class="soc_icon-twitter-3"></i></a>',
									enableHover: false,
									enableCounter: false,
									urlCurl: $share_container.data('directory') + '/inc' + '/sharrre.php',
									click: function (api, options) {
										api.simulateClick();
										api.openPopup('twitter');
									}
								});



								$('.module-entry-share-link-googleplus', $share_container).sharrre({
									share: {
										googlePlus: true
									},
									template: '<a href="#"><i class="soc_icon-google__x2B_"></i></a>',
									enableHover: false,
									enableCounter: false,
									urlCurl: $share_container.data('directory') + '/inc' + '/sharrre.php',

									click: function (api, options) {
										api.simulateClick();
										api.openPopup('googlePlus');
									}
								});

								$('.module-entry-share-link-linkedin', $share_container).sharrre({
									share: {
										linkedin: true
									},
									template: '<a href="#"><i class="soc_icon-linkedin"></i></a>',
									enableHover: false,
									enableCounter: false,
									urlCurl: $share_container.data('directory') + '/inc' + '/sharrre.php',

									click: function (api, options) {
										api.simulateClick();
										api.openPopup('linkedin');
									}
								});

								$('.module-entry-share-link-pinterest', $share_container).sharrre({
									share: {
										pinterest: true
									},
									/*TODO: add image for pinterest
									buttons: { 
										pinterest: {
											url: jQuery('.entry-share-link-pinterest', $share_container).attr("data-url"), 
											media: jQuery('.entry-share-link-pinterest', $share_container).attr("data-media"), 
										}
									},*/
									template: '<a href="#"><i class="soc_icon-pinterest"></i></a>',
									enableHover: false,
									enableCounter: false,
									urlCurl: $share_container.data('directory') + '/inc' + '/sharrre.php',

									click: function (api, options) {
										api.simulateClick();
										api.openPopup('pinterest');
									}
								});

								var setShareWidth = function() {
									if($(window).width() > 800) {
										$share_container.pricingTableEqColumns();
									} else {
										$share_container.width('100%');
									}
								};
								setShareWidth();
								$(window).resize(setShareWidth);
							}
						});
					})(jQuery);
				</script>
			
			<?php
			echo '</div>';
			$output .= ob_get_clean();
			
			return $output;
		}
	}
}
if(class_exists('Dfd_Share_Module'))
{
	$Dfd_Share_Module = new Dfd_Share_Module;
}
