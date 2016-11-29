<?php
/*
* Add-on Name: Announcement Line
*/
if ( ! class_exists( 'Crum_Announcement' ) ) {
	/**
	 * Class Crum_Announcement
	 */
	class Crum_Announcement {
		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action( 'init', array( $this, '_crum_announcement_init' ) );
			add_shortcode( 'announcement', array( $this, '_crum_announcement_shortcode' ) );
		}

		/**
		 * Block options.
		 */
		function _crum_announcement_init() {
			if ( function_exists( 'vc_map' ) ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/Dfd_VC_Addons/admin/img/announcement/';
				vc_map(
					array(
						'name'        => esc_html__( 'Announcement', 'dfd' ),
						'base'        => 'announcement',
						'class'       => 'vc_info_banner_icon',
						'icon'        => 'vc_icon_info_banner',
						'category'    => esc_html__( 'NEW VC Addons', 'dfd' ),
						'description' => esc_html__( 'Display announcement with icon', 'dfd' ),
						'params'      => array(
							array(
								'heading'    => esc_html__( 'Choose Style', 'dfd' ),
								'type'       => 'radio_image_select',
								'param_name' => 'main_style',
								'options'    => array(
									'style-1' => $module_images . 'style-1.png',
									'style-2' => $module_images . 'style-2.png',
									'style-3' => $module_images . 'style-3.png',
								),
							),
							array(
								'heading'     => esc_html__( 'Select Layout', 'dfd' ),
								'description' => '',
								'type'        => 'radio_image_select',
								'param_name'  => 'main_layout',
								'options'     => array(
									'layout-1' => $module_images . 'layout-1.png',
									'layout-2' => $module_images . 'layout-2.png',
									'layout-3' => $module_images . 'layout-3.png',
									'layout-4' => $module_images . 'layout-4.png',
								),
							),
							array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Extra class name', 'js_composer' ),
								'param_name'  => 'el_class',
								'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
							),
							array(
								'type'       => 'textarea_html',
								'heading'    => esc_html__( 'Content', 'dfd' ),
								'param_name' => 'content',
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type'       => 'icon_manager',
								'heading'    => esc_html__( 'Select Icon ', 'dfd' ),
								'param_name' => 'icon',
								'std'        => 'dfd-icon-navigation',
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Content', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'content_t_heading',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
								'class'            => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type'       => 'crumina_font_container',
								'heading'    => '',
								'param_name' => 'font_options',
								'settings'   => array(
									'fields' => array(
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style',
									),
								),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Use custom font family?', 'dfd' ),
								'param_name'  => 'use_google_fonts',
								'value'       => array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
								'description' => esc_html__( 'Use font family from google.', 'dfd' ),
								'group'       => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'       => 'google_fonts',
								'param_name' => 'custom_fonts',
								'value'      => '',
								'group'      => esc_attr__( 'Typography', 'dfd' ),
								'settings'   => array(
									'fields' => array(
										'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
										'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
									),
								),
								'dependency' => array(
									'element' => 'use_google_fonts',
									'value'   => 'yes',
								),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Icon style', 'dfd' ),
								'param_name'       => 'thumb_t_heading',
								'class'            => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'number',
								'heading'          => esc_html__( 'Border radius', 'dfd' ),
								'param_name'       => 'icon_radius',
								'min'              => 0,
								'edit_field_class' => 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'colorpicker',
								'heading'          => esc_html__( 'Color', 'dfd' ),
								'param_name'       => 'icon_color',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'colorpicker',
								'heading'          => esc_html__( 'Background', 'dfd' ),
								'param_name'       => 'icon_bg',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Content style', 'dfd' ),
								'param_name'       => 'del_t_heading',
								'class'            => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'number',
								'heading'          => esc_html__( 'Border width', 'dfd' ),
								'param_name'       => 'content_border',
								'min'              => 0,
								'edit_field_class' => 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'colorpicker',
								'heading'          => esc_html__( 'Border color', 'dfd' ),
								'param_name'       => 'border_color',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'colorpicker',
								'heading'          => esc_html__( 'Background', 'dfd' ),
								'param_name'       => 'content_bg',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'number',
								'heading'          => esc_html__( 'Border radius', 'dfd' ),
								'param_name'       => 'content_radius',
								'min'              => 0,
								'edit_field_class' => 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'ult_switch',
								'heading'          => esc_html__( 'Dark Background', 'dfd' ),
								'param_name'       => 'dark_bg',
								'value'      => '',
								'options'    => array(
									'show' => array(
										'label' => __( 'You use dark background?', 'dfd' ),
										'on'    => esc_html__( 'Yes', 'dfd' ),
										'off'   => esc_html__( 'No', 'dfd' ),
									),
								),
								'dependency' => array(
									'element' => 'main_style',
									'value'   => array( 'style-1' ),
								),
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'dropdown',
								'class'      => '',
								'heading'    => esc_html__( 'Animation', 'dfd' ),
								'param_name' => 'module_animation',
								'value'      => dfd_module_animation_styles(),
								'group'      => esc_html__( 'Animation', 'dfd' ),
							),
						),
					)
				);
			}
		}

		/**
		 * Parse TEXT params in shortcodes.
		 *
		 * @param $string
		 *
		 * @return string
		 */
		function _crum_parse_text_shortcode_params( $string ) {
			$parsed_param = array();
			$param_value  = explode( '|', $string );
			if ( is_array( $param_value ) ) {
				foreach ( $param_value as $single_param ) {
					$single_param                     = explode( ':', $single_param );
					$parsed_param[ $single_param[0] ] = $single_param[1];
				}
			}

			return $parsed_param;
		}

		/**
		 * Shortcode handler function.
		 *
		 * @param array  $atts    Shortcode atributes.
		 * @param string $content Text Field.
		 *
		 * @return string
		 */
		function _crum_announcement_shortcode( $atts, $content ) {
			$main_style = $main_layout = $icon = $font_options = $use_google_fonts = $custom_fonts = $icon_radius = $icon_bg = $icon_color = $content_border = $border_color = $content_bg = $content_radius = $dark_bg = '';
			$icon_style = $content_style = $content_typo = $icon_html = $content_html = '';
			$output     = $el_class = $module_animation = '';

			extract( shortcode_atts( array(
				'main_style'       => 'style-1',
				'main_layout'      => 'layout-1',
				'icon'             => 'dfd-icon-navigation',
				'font_options'     => '',
				'use_google_fonts' => '',
				'custom_fonts'     => '',
				'icon_radius'      => '',
				'icon_bg'          => '',
				'icon_color'       => '',
				'content_border'   => '',
				'border_color'     => '',
				'content_bg'       => '',
				'content_radius'   => '',
				'dark_bg'          => '',
				'module_animation' => '',
				'el_class'         => '',
			), $atts ) );

			// Create parts of module according to parameters.
			// Avatar HTML.
			if ( ! empty( $icon ) ) {

				if ( $icon_bg || $icon_radius || $icon_color ) {

					$icon_style .= 'style="';
					if ( $icon_bg ) {
						$icon_style .= 'background:' . $icon_bg . '; ';
					}
					if ( $icon_radius ) {
						$icon_style .= 'border-radius:' . $icon_radius . 'px; ';
					}
					if ( $icon_color ) {
						$icon_style .= 'color:' . $icon_color . ';';
					}

					$icon_style .= '"';
				}

				$icon_html .= '<div class="module-icon" ' . $icon_style . '>';
				$icon_html .= '<i class = "' . $icon . '"></i>';
				$icon_html .= '</div>';
			}

			// Text Typography.
			$font_options = $this->_crum_parse_text_shortcode_params( $font_options );
			if ( ! empty( $font_options ) && is_array( $font_options ) ) {
				$content_typo .= 'style="';

				if ( 'yes' === $use_google_fonts ) {

					$google_fonts_obj  = new Vc_Google_Fonts();
					$google_fonts_data = strlen( $custom_fonts ) > 0 ? $google_fonts_obj->_vc_google_fonts_parse_attributes( array(), $custom_fonts ) : '';

					$google_fonts_family = explode( ':', $google_fonts_data['values']['font_family'] );
					$content_typo .= 'font-family:' . $google_fonts_family[0] . '; ';
					$google_fonts_styles = explode( ':', $google_fonts_data['values']['font_style'] );
					$content_typo .= 'font-weight:' . $google_fonts_styles[1] . '; ';
					$content_typo .= 'font-style:' . $google_fonts_styles[2] . '; ';

					$settings = get_option( 'wpb_js_google_fonts_subsets' );
					if ( is_array( $settings ) && ! empty( $settings ) ) {
						$subsets = '&subset=' . implode( ',', $settings );
					} else {
						$subsets = '';
					}

					if ( isset( $google_fonts_data['values']['font_family'] ) ) {
						wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
					}
				}

				foreach ( $font_options as $key => $value ) {
					if ( strlen( $value ) > 0 ) {
						if ( 'font_style_italic' === $key ) {
							$content_typo .= 'font-style:italic; ';
						} elseif ( 'font_style_bold' === $key ) {
							$content_typo .= 'font-weight:bold; ';
						} elseif ( 'font_style_underline' === $key ) {
							$content_typo .= 'text-decoration:underline; ';
						} elseif ( 'color' === $key ) {
							$content_typo .= $key . ': ' . str_replace( '%23', '#', $value ) . '; ';
						} else {
							$content_typo .= str_replace( '_', '-', $key ) . ': ' . $value . 'px; ';
						}
					}
				}

				$content_typo .= '"';
			}

			$content_html .= '<div class="module-text" ' . $content_typo . '>' . do_shortcode( strip_tags( $content ) ) . '</div>';

			if ( $content_border || $border_color || $content_bg || $content_radius ) {
				$content_style .= 'style="';
				if ( $content_border ) {
					$content_style .= 'border:' . $border_color . ' ' . $content_border . ' solid; ';
				}
				if ( $content_radius ) {
					$content_style .= 'border-radius:' . $content_radius . 'px; ';
				}
				if ( $content_bg ) {
					$content_style .= 'background-color:' . $content_bg . ';';
				}
				$content_style .= '"';
			}

			$animate = $animation_data = '';

			if ( ! ( '' === $module_animation ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr( $module_animation ) . '" ';
			}

			if ($dark_bg) {
				$dark_bg = 'dark-bg';
			}
			// Module output according to layout selection.
			$output .= '<div ' . $content_style . ' class="dfd-announce-module '.$dark_bg.' ' . $main_style . ' ' . $main_layout . ' ' . esc_attr( $animate ) . '" ' . $animation_data . '>';
			$output .= $icon_html;
			$output .= $content_html;
			$output .= '</div>';

			return $output;
		}
	}
}
if ( class_exists( 'Crum_Announcement' ) ) {
	$Crum_Announcement = new Crum_Announcement;
}
